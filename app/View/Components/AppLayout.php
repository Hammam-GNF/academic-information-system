<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public function render(): View
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (! $user) {
            return view('layouts.app');
        }

        if ($user->hasRole('admin')) {
            return view('layouts.admin');
        }

        if ($user->hasRole('user')) {
            return view('layouts.user');
        }

        return view('layouts.app');
    }
}
