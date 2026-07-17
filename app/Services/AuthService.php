<?php

namespace App\Services;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class AuthService implements AuthServiceInterface
{

    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {}

    /**
     * Resolve dashboard route based on user role.
     */
    private function getDashboardRoute(User $user): string
    {
        return $user->hasRole('admin')
            ? route('admin.dashboard')
            : route('dashboard');
    }

    /**
     * Redirect user after email verification.
     */
    private function redirectAfterVerification(User $user): RedirectResponse
    {
        return redirect()->intended(
            $this->getDashboardRoute($user).'?verified=1'
        );
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        return redirect()
            ->intended(
                $this->getDashboardRoute($user)
            )
            ->with(
                'success',
                "Welcome back, {$user->name}."
            );
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = $this->userRepository->create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'password' => $request->validated('password'),
        ]);

        $user->assignRole('user');

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard'))
            ->with(
                'success',
                "Welcome {$user->name}, your account has been created."
            );
    }

    public function sendPasswordResetLink(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', __($status))
            : back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => __($status),
                ]);
                
    }

    public function resetPassword(ResetPasswordRequest $request): RedirectResponse
    {
        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            function ($user) use ($request) {

                $user->forceFill([
                    'password' => Hash::make(
                        $request->validated('password')
                    ),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()
                ->route('login')
                ->with('success', __($status))
            : back()
                ->withInput(
                    $request->only('email')
                )
                ->withErrors([
                    'email' => __($status),
                ]);
    }

    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        $request->user()->update([
            'password' => Hash::make(
                $request->validated('password')
            ),
        ]);

        return back()->with(
            'success',
            'Password updated successfully.'
        );
    }

    public function verifyEmail(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectAfterVerification(
                $request->user()
            );
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->redirectAfterVerification(
            $request->user()
        );
    }

    public function sendEmailVerificationNotification(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectAfterVerification(
                $request->user()
            );
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with(
            'success',
            'Verification link sent successfully.'
        );
    }

    public function confirmPassword(Request $request): RedirectResponse
    {
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put(
            'auth.password_confirmed_at',
            time()
        );

        return redirect()->intended(
            $this->getDashboardRoute(
                $request->user()
            )
        );
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')
            ->with(
                'success',
                'Logged out successfully.'
            );
    }
}
