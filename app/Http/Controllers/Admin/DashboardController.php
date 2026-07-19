<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [

            'totalUsers' => User::count(),

            'totalAdmins' => User::whereHas('roles', function ($query) {

                $query->where('name', 'admin');

            })->count(),

            'totalActivities' => Activity::count(),

            'recentActivities' => Activity::latest()
                ->take(5)
                ->get(),

        ]);
    }
}
