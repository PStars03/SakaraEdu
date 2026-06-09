<?php

use App\Http\Controllers\AdminBootcampController;
use App\Http\Controllers\AdminNewsController;
use App\Http\Controllers\AdminScholarshipController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BootcampController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ScholarshipController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/beasiswa', [ScholarshipController::class, 'index'])->name('scholarships.index');
Route::get('/beasiswa/{slug}', [ScholarshipController::class, 'show'])->name('scholarships.show');

Route::get('/bootcamp', [BootcampController::class, 'index'])->name('bootcamps.index');
Route::get('/bootcamp/{slug}', [BootcampController::class, 'show'])->name('bootcamps.show');

Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');

/*
|--------------------------------------------------------------------------
| Guest Only Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // User dashboard & finance plans
    Route::middleware('role:user')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'userDashboard'])
            ->name('dashboard');
            
        Route::resource('uang-beasiswa', \App\Http\Controllers\ScholarshipFinancePlanController::class);
    });

    // Admin & Super Admin CRUD Routes
    Route::middleware('role:admin,super_admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])
            ->name('dashboard');
        
        Route::resource('beasiswa', AdminScholarshipController::class)->except(['destroy', 'show']);
        Route::resource('bootcamp', AdminBootcampController::class)->except(['destroy', 'show']);
        Route::resource('berita', AdminNewsController::class)->except(['destroy', 'show']);
    });

    // Super Admin routes
    Route::middleware('role:super_admin')->prefix('super-admin')->name('super-admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'superAdminDashboard'])
            ->name('dashboard');
            
        Route::resource('admins', \App\Http\Controllers\AdminManagementController::class)->except(['show']);
            
        Route::delete('beasiswa/{id}', [AdminScholarshipController::class, 'destroy'])->name('beasiswa.destroy');
        Route::delete('bootcamp/{id}', [AdminBootcampController::class, 'destroy'])->name('bootcamp.destroy');
        Route::delete('berita/{id}', [AdminNewsController::class, 'destroy'])->name('berita.destroy');
    });
});
