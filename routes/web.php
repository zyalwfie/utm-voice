<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadController;

Route::get('/', App\Livewire\Landing\Index::class)->name('landing.index');
Route::get('/fasilitas', App\Livewire\Facility\Index::class)->name('landing.facility.index');
Route::get('/fasilitas/{facility}', App\Livewire\Facility\Show::class)->name('landing.facility.show');

Route::middleware('guest')->group(function () {
    Route::get('/masuk', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/masuk', [AuthController::class, 'login']);
});

Route::post('/keluar', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'user'])->prefix('pengguna/dasbor')->name('user.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('user.questionnaire.index');
    })->name('dashboard');

    Route::get('/kuesioner', App\Livewire\User\Questionnaire\Index::class)
        ->name('questionnaire.index');
});

Route::middleware(['auth', 'admin'])->prefix('dasbor/admin')->name('dashboard.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard.facility.index');
    })->name('index');

    Route::get('/fasilitas', App\Livewire\Dashboard\Facility\Index::class)
        ->name('facility.index');

    Route::get('/kuesioner', App\Livewire\Dashboard\Evaluate\Index::class)
        ->name('evaluate.index');

    Route::post('/unggah/karousel', [UploadController::class, 'uploadCarousel'])->name('upload.carousel');
    Route::post('/unggah/utama', [UploadController::class, 'uploadDetail'])->name('upload.detail');
    Route::delete('/unggah/hapus/{filename}', [UploadController::class, 'deleteFile'])->name('upload.delete');
});
