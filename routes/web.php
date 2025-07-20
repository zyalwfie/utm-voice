<?php

use App\Livewire\Facility\Index as Facility;
use App\Livewire\Facility\Show as FacilityShow;
use App\Livewire\Landing\Index as Landing;
use Illuminate\Support\Facades\Route;

Route::get('/', Landing::class)->name('landing.index');
Route::get('/facility', Facility::class)->name('landing.facility');
Route::get('/facility/{facility}', FacilityShow::class)->name('landing.facility.show');
