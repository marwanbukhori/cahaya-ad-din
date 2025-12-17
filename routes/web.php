<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/my/submissions', [App\Http\Controllers\SubmissionController::class, 'index'])->name('submissions.index');
    Route::get('/my/submissions/{submission}/pdf', [App\Http\Controllers\SubmissionController::class, 'pdf'])->name('submissions.pdf');
    Route::get('/forms/{type}', [App\Http\Controllers\SubmissionController::class, 'show'])->name('forms.show');
    Route::post('/submit', [App\Http\Controllers\SubmissionController::class, 'store'])->name('submissions.store');
});

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/submissions', [App\Http\Controllers\AdminController::class, 'index'])->name('submissions.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
