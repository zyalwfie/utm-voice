<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadController;

Route::get('/', App\Livewire\Landing\Index::class)->name('landing.index');
Route::get('/facility', App\Livewire\Facility\Index::class)->name('landing.facility');
Route::get('/facility/{facility}', App\Livewire\Facility\Show::class)->name('landing.facility.show');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('dashboard.facility.index');
    })->name('dashboard');

    Route::get('/dashboard/facility', App\Livewire\Dashboard\Facility\Index::class)
        ->name('dashboard.facility.index');

    Route::get('/dashboard/review', App\Livewire\Dashboard\Review\Index::class)
        ->name('dashboard.review.index');

    Route::get('/dashboard/evaluate', App\Livewire\Dashboard\Evaluate\Index::class)->name('dashboard.evaluate.index');

    Route::post('/upload/carousel', [UploadController::class, 'uploadCarousel'])->name('upload.carousel');
    Route::post('/upload/detail', [UploadController::class, 'uploadDetail'])->name('upload.detail');
    Route::delete('/upload/delete/{filename}', [UploadController::class, 'deleteFile'])->name('upload.delete');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
