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

        if (
            $user &&
            $user->hasRole('admin')
        ) {
            return view('layouts.admin');
        }

        return view('layouts.app');
    }
}
