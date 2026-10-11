<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard', ['role' => User::normalizeRole(auth()->user()->role)])
        : redirect()->route('login');
});

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
    Route::get('/register', [AuthController::class, 'createRegistration'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function (): void {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

    Route::get('/dashboard/{role}', [DashboardController::class, 'show'])
        ->whereIn('role', User::ROLES)
        ->middleware('role:{role}')
        ->name('dashboard');

    Route::get('/dashboard/pharmacist', [DashboardController::class, 'pharmacist'])
        ->middleware('role:pharmacist-manager')
        ->name('dashboard.pharmacist');
    Route::get('/dashboard/cashier', [DashboardController::class, 'cashier'])
        ->middleware('role:cashier-sales-staff')
        ->name('dashboard.cashier');
    Route::get('/dashboard/supplier', [DashboardController::class, 'supplier'])
        ->middleware('role:supplier-vendor')
        ->name('dashboard.supplier');

    Route::resource('users', UserController::class)
        ->except('show')
        ->middleware('role:administrator');
});
