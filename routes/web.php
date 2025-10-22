<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeamAdminController;
use App\Http\Controllers\TeamUserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Role-based routes
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Team Management
        Route::get('/teams', [AdminController::class, 'teams'])->name('admin.teams');
        Route::get('/teams/create', [AdminController::class, 'createTeam'])->name('admin.teams.create');
        Route::post('/teams', [AdminController::class, 'storeTeam'])->name('admin.teams.store');
        Route::get('/teams/{team}/edit', [AdminController::class, 'editTeam'])->name('admin.teams.edit');
        Route::put('/teams/{team}', [AdminController::class, 'updateTeam'])->name('admin.teams.update');
        Route::delete('/teams/{team}', [AdminController::class, 'destroyTeam'])->name('admin.teams.destroy');
        
        // User Management
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    });
    
    Route::prefix('team-admin')->middleware('role:team_admin')->group(function () {
        Route::get('/', [TeamAdminController::class, 'index'])->name('team-admin.dashboard');
    });
    
    Route::prefix('team-user')->middleware('role:team_user')->group(function () {
        Route::get('/', [TeamUserController::class, 'index'])->name('team-user.dashboard');
    });
});
