<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadController;
use App\Livewire\Landing\Index as Landing;
use App\Livewire\Facility\Index as Facility;
use App\Livewire\Facility\Show as FacilityShow;
use App\Livewire\Dashboard\Review\Index as DashboardReviewIndex;
use App\Livewire\Dashboard\Facility\Index as DashboardFacilityIndex;

Route::get('/', Landing::class)->name('landing.index');
Route::get('/facility', Facility::class)->name('landing.facility');
Route::get('/facility/{facility}', FacilityShow::class)->name('landing.facility.show');

// Route::middleware(['auth'])->group(function() {
//     Route::get('/dashboard', DashboardIndex::class)->name('dashboard.index');
// });

Route::get('/dashboard/facility', DashboardFacilityIndex::class)->name('dashboard.facility.index');
Route::get('/dashboard/review', DashboardReviewIndex::class)->name('dashboard.review.index');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Dashboard Routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard redirect
    Route::get('/dashboard', function () {
        return redirect()->route('dashboard.facility.index');
    })->name('dashboard');

    // Facility management
    Route::get('/dashboard/facility', App\Livewire\Dashboard\Facility\Index::class)
        ->name('dashboard.facility.index');

    // Review management
    Route::get('/dashboard/review', App\Livewire\Dashboard\Review\Index::class)
        ->name('dashboard.review.index');

    // Upload routes for FilePond
    Route::post('/upload/carousel', [UploadController::class, 'uploadCarousel'])->name('upload.carousel');
    Route::post('/upload/detail', [UploadController::class, 'uploadDetail'])->name('upload.detail');
    Route::delete('/upload/delete/{filename}', [UploadController::class, 'deleteFile'])->name('upload.delete');
});

Route::middleware(['auth'])->group(function () {
    // Upload routes
    Route::post('/upload/carousel', [UploadController::class, 'uploadCarousel'])->name('upload.carousel');
    Route::post('/upload/detail', [UploadController::class, 'uploadDetail'])->name('upload.detail');
    Route::delete('/upload/delete/{filename}', [UploadController::class, 'deleteFile'])->name('upload.delete');
});
