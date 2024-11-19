<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SentimentController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard route - both admin and user will use the same dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile routes (optional)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin-specific routes
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manageUsers');
    
    // Handle user update in the same view
    Route::post('/admin/update-user/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    
    // Handle user deletion
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
});

Route::middleware(['auth'])->group(function () {
    // Route for displaying the sentiment analysis form
    Route::get('/sentiment-analyze', function () {
        return view('sentiment-analyze');
    })->name('sentiment.form');

    // Route for processing the sentiment analysis
    Route::post('/sentiment-analyze', [SentimentController::class, 'analyze'])->name('sentiment.analyze');

    // Route for displaying sentiment history
    Route::get('/sentiment-history', [SentimentController::class, 'history'])->name('sentiment.history');

    Route::get('/export/pdf', [SentimentController::class, 'exportToPDF'])->name('export.pdf');
    Route::get('/export/csv', [SentimentController::class, 'exportToCSV'])->name('export.csv');
});



require __DIR__.'/auth.php';

