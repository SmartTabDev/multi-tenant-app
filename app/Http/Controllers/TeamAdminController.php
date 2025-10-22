<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamAdminController extends Controller
{
    public function index()
    {
        return view('team-admin.dashboard');
    }
}