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
        
        // Team User Management
        Route::get('/users', [TeamAdminController::class, 'users'])->name('team-admin.users');
        Route::get('/users/{user}/edit', [TeamAdminController::class, 'editUser'])->name('team-admin.users.edit');
        Route::put('/users/{user}', [TeamAdminController::class, 'updateUser'])->name('team-admin.users.update');
        Route::delete('/users/{user}', [TeamAdminController::class, 'removeUser'])->name('team-admin.users.remove');
        
        // Product Management
        Route::get('/products', [TeamAdminController::class, 'products'])->name('team-admin.products');
        Route::get('/products/create', [TeamAdminController::class, 'createProduct'])->name('team-admin.products.create');
        Route::post('/products', [TeamAdminController::class, 'storeProduct'])->name('team-admin.products.store');
        Route::get('/products/{product}/edit', [TeamAdminController::class, 'editProduct'])->name('team-admin.products.edit');
        Route::put('/products/{product}', [TeamAdminController::class, 'updateProduct'])->name('team-admin.products.update');
        Route::delete('/products/{product}', [TeamAdminController::class, 'destroyProduct'])->name('team-admin.products.destroy');
        
        // Categories (read-only)
        Route::get('/categories', [TeamAdminController::class, 'categories'])->name('team-admin.categories');
    });
    
    Route::prefix('team-user')->middleware('role:team_user')->group(function () {
        Route::get('/', [TeamUserController::class, 'index'])->name('team-user.dashboard');
        
        // Product Viewing
        Route::get('/products', [TeamUserController::class, 'products'])->name('team-user.products');
        
        // My Products (own products only)
        Route::get('/my-products', [TeamUserController::class, 'myProducts'])->name('team-user.my-products');
        Route::get('/my-products/create', [TeamUserController::class, 'createProduct'])->name('team-user.my-products.create');
        Route::post('/my-products', [TeamUserController::class, 'storeProduct'])->name('team-user.my-products.store');
        Route::get('/my-products/{product}/edit', [TeamUserController::class, 'editProduct'])->name('team-user.my-products.edit');
        Route::put('/my-products/{product}', [TeamUserController::class, 'updateProduct'])->name('team-user.my-products.update');
        Route::delete('/my-products/{product}', [TeamUserController::class, 'destroyProduct'])->name('team-user.my-products.destroy');
        
        // Categories (read-only)
        Route::get('/categories', [TeamUserController::class, 'categories'])->name('team-user.categories');
    });
});
