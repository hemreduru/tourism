<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;

class AdminDashboardController extends Controller
{


    /**
     * Admin dashboard sayfasını gösterir
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stats = [
            'users_count' => User::count(),
            'roles_count' => Role::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
