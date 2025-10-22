<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamUserController extends Controller
{
    public function index()
    {
        return view('team-user.dashboard');
    }
}