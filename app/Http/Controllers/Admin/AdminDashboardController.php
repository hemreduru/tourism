<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [];
        $latestUsers = collect();
        $roleDistribution = collect();

        if (auth()->user()->hasPermission('users.view')) {
            $stats = array_merge($stats, $this->getUserStats());
            $latestUsers = $this->getLatestUsers();
        }

        if (auth()->user()->hasPermission('roles.view')) {
            $stats['roles_count'] = Role::count();
            $roleDistribution = $this->getRoleDistribution();
        }

        if (auth()->user()->hasPermission('permissions.view')) {
            $stats['permissions_count'] = Permission::count();
        }

        return view('admin.dashboard', compact('stats', 'latestUsers', 'roleDistribution'));
    }

    private function getUserStats(): array
    {
        $now = Carbon::now();
        
        return [
            'users_count' => User::count(),
            'active_users' => User::where('email_verified_at', '!=', null)
                ->where('is_active', true)
                ->where('last_login_at', '>=', $now->copy()->subDays(30))
                ->count(),
            'users_today' => User::whereDate('created_at', $now->toDateString())->count(),
            'users_this_week' => User::whereBetween('created_at', [
                $now->copy()->startOfWeek(),
                $now->copy()->endOfWeek()
            ])->count(),
            'users_this_month' => User::whereYear('created_at', $now->year)
                ->whereMonth('created_at', $now->month)
                ->count()
        ];
    }

    private function getLatestUsers()
    {
        return User::with('roles')
            ->latest()
            ->take(5)
            ->get();
    }

    private function getRoleDistribution()
    {
        return Role::withCount('users')
            ->get()
            ->map(fn ($role) => [
                'name' => $role->display_name,
                'count' => $role->users_count
            ]);
    }
}
