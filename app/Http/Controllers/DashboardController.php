<?php

namespace App\Http\Controllers;

use App\Models\Bootcamp;
use App\Models\News;
use App\Models\Scholarship;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Universal dashboard entry point — redirects to the correct dashboard based on role.
     */
    public function index()
    {
        $user = auth()->user();

        return match ($user->role) {
            'super_admin' => redirect()->route('super-admin.dashboard'),
            'admin' => redirect()->route('admin.dashboard'),
            default => redirect()->route('user.dashboard'),
        };
    }

    public function userDashboard()
    {
        $user = auth()->user();
        return view('dashboard.user', [
            'financePlanCount' => $user->financePlans()->count(),
            'bookmarkCount'    => $user->bookmarks()->count(),
        ]);
    }

    public function adminDashboard()
    {
        return view('dashboard.admin', [
            'scholarshipCount' => Scholarship::count(),
            'bootcampCount' => Bootcamp::count(),
            'newsCount' => News::count(),
        ]);
    }

    public function superAdminDashboard()
    {
        return view('dashboard.super-admin');
    }
}
