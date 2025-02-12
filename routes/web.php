<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public home page
Route::get('/', function () {
    return view('welcome');
});

// Redirect users based on their role after login
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.home');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Dashboard Route
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard/{section?}', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/home', function () {
        return view('admin.home');
    })->name('admin.home');

    Route::get('/books', function () {
        return view('admin.books');
    })->name('admin.books');

    Route::get('/circulation', function () {
        return view('admin.circulation');
    })->name('admin.circulation');

    Route::get('/notify', function () {
        return view('admin.notify');
    })->name('admin.notify');

    Route::get('/admin-panel', function () {
        return view('admin.panel');
    })->name('admin.panel');

    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');

    Route::get('/reports', function () {
        return view('admin.reports');
    })->name('admin.reports');
});

// User Dashboard Route
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('posts', PostController::class)->except(['show', 'update', 'store']);
});

// Load authentication routes
require __DIR__ . '/auth.php';
