<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CirculationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public home page
Route::get('/', function () {
    return view('welcome');
});

// Redirect users based on their role after login
Route::get('/', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.layout', ['section' => 'dashboard']);
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Dashboard Route
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/layout/{section?}', [AdminDashboardController::class, 'index'])->name('admin.layout');

    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


    Route::get('/books/index', [BookController::class, 'index'])->name('admin.books.index');
    Route::get('/books.edit', [BookController::class, 'edit'])->name('admin.books.edit');


    Route::get('/circulation', function () {
        return view('admin.circulation');
    })->name('admin.circulation');

    Route::get('/notify', function () {
        return view('admin.notify');
    })->name('admin.notify');

    Route::get('/admin-panel', function () {
        return view('admin.manage_users.panel');
    })->name('admin.manage_users.panel');

    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');

    Route::get('/reports', function () {
        return view('admin.reports');
    })->name('admin.reports');

    // Resource Routes for Books
    Route::resource('/admin/books', BookController::class);

    Route::get('/circulation/select-user', [CirculationController::class, 'selectUser'])->name('circulation.select-user');

    Route::get('/issue-book', [CirculationController::class, 'showUsers'])->name('issue-book');
    Route::get('/issue-book/{user}', [CirculationController::class, 'showBooks'])->name('view-available-books');
    Route::post('/issue-book/{user}/{book}', [CirculationController::class, 'issueBook'])->name('issue-book.store');
    Route::get('/circulation/{user}/books/{book}/create-loan', [CirculationController::class, 'createLoanForm'])->name('create-loan-form');
    Route::post('/circulation/{user}/books/{book}/issue', [CirculationController::class, 'issueBook'])->name('issue-book.store');
    Route::get('/admin/circulation', [CirculationController::class, 'index'])->name('admin.circulation');
    Route::get('/admin/circulation', [CirculationController::class, 'index'])->name('admin.circulation');
    Route::get('/admin/select-user-with-loans', [CirculationController::class, 'selectUserWithLoans'])->name('select-user-with-loans');
    Route::get('/admin/user/{user}/loaned-books', [CirculationController::class, 'viewLoanedBooks'])->name('view-loaned-books');
    Route::put('/admin/loan/{loan}/return', [CirculationController::class, 'returnBook'])->name('return-book');
    Route::get('/admin/notify', [CirculationController::class, 'notifyOverdueMembers'])->name('notify-overdue-members');
    Route::get('/admin/notify/{user}/reminder', [CirculationController::class, 'sendReminder'])->name('send-reminder');
    Route::get('/admin/manage-users', [AdminDashboardController::class, 'getUsers'])->name('admin.manage_users.index');
    Route::get('/admin/manage-users/{id}/edit', [AdminDashboardController::class, 'editUser'])->name('admin.manage_users.edit');
    Route::put('/admin/manage-users/{id}', [AdminDashboardController::class, 'updateUser'])->name('admin.manage_users.update');
    Route::delete('/admin/manage-users/{id}', [AdminDashboardController::class, 'deleteUser'])->name('admin.manage_users.delete');
    Route::get('/system-logs', [AdminDashboardController::class, 'showLogs'])
        ->name('admin.system_logs');
    // Display Settings Page
    Route::get('/admin/settings', [AdminDashboardController::class, 'showSettings'])->name('admin.settings');

    // Update Settings
    Route::put('/admin/settings', [AdminDashboardController::class, 'updateSettings'])->name('admin.update_settings');




});

// User Dashboard Route
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/user/layout/{section?}', [UserDashboardController::class, 'index'])->name('user.layout');

    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');


    Route::get('/borrowed-books', [UserDashboardController::class, 'showBorrowedBooks'])->name('user.borrowed-books');
    Route::get('/due-books', [UserDashboardController::class, 'showDueBooks'])->name('user.due-books');

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
