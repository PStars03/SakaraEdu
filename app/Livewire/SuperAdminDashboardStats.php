<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Scholarship;
use App\Models\Bootcamp;
use App\Models\News;
use Illuminate\Support\Facades\DB;

class SuperAdminDashboardStats extends Component
{
    public function render()
    {
        $activeSessions = DB::table('sessions')
            ->whereNotNull('user_id')
            ->where('last_activity', '>=', now()->subMinutes(5)->getTimestamp())
            ->pluck('user_id');

        $onlineUsers = User::whereIn('id', $activeSessions)
            ->whereIn('role', ['user', 'admin'])
            ->get();

        return view('livewire.super-admin-dashboard-stats', [
            'adminCount' => User::where('role', 'admin')->count(),
            'scholarshipCount' => Scholarship::count(),
            'bootcampCount' => Bootcamp::count(),
            'newsCount' => News::count(),
            'onlineUsers' => $onlineUsers,
            'onlineCount' => $onlineUsers->count(),
        ]);
    }
}
