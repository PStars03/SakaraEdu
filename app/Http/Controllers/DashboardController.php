<?php

namespace App\Http\Controllers;

use App\Models\Bootcamp;
use App\Models\News;
use App\Models\Scholarship;
use App\Models\User;

class DashboardController extends Controller
{
    public function userDashboard()
    {
        return view('dashboard.user');
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
