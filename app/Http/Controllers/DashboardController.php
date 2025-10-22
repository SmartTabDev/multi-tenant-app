<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Determine user role and redirect accordingly
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'team_admin') {
            return redirect()->route('team-admin.dashboard');
        } elseif ($user->role === 'team_user') {
            return redirect()->route('team-user.dashboard');
        }
        
        // Default dashboard for users without specific role
        return view('dashboard', compact('user'));
    }
}