<?php

use App\Http\Controllers\AuthController;
use App\Livewire\Dashboard\Facility\Index as DashboardFacilityIndex;
use App\Livewire\Dashboard\Review\Index as DashboardReviewIndex;
use App\Livewire\Facility\Index as Facility;
use App\Livewire\Facility\Show as FacilityShow;
use App\Livewire\Landing\Index as Landing;
use Illuminate\Support\Facades\Route;

Route::get('/', Landing::class)->name('landing.index');
Route::get('/facility', Facility::class)->name('landing.facility');
Route::get('/facility/{facility}', FacilityShow::class)->name('landing.facility.show');

// Route::middleware(['auth'])->group(function() {
//     Route::get('/dashboard', DashboardIndex::class)->name('dashboard.index');
// });

Route::get('/dashboard/facility', DashboardFacilityIndex::class)->name('dashboard.facility.index');
Route::get('/dashboard/review', DashboardReviewIndex::class)->name('dashboard.review.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
});
