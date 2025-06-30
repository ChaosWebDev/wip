<?php

use App\Livewire\Desktop;
use App\Livewire\Settings;
use Illuminate\Support\Facades\Route;

require_once __DIR__ . "/debug.php";

// ! BASE ROUTE ! //
Route::get('/', Desktop::class)->name('desktop');

// * MEDICAL ROUTES * //
Route::prefix('medical')->name('medical.')->group(function () {
    Route::get('/', Desktop::class)->name('index');
});

// * DRIVE ROUTES * //
Route::prefix('drive')->name('drive.')->group(function () {
    Route::get('/', Desktop::class)->name('index');
});

// * WEATHER ROUTES * //
Route::prefix('weather')->name('weather.')->group(function () {
    Route::get('/', Desktop::class)->name('index');
});

// * SCHOOL ROUTES * //
Route::prefix('school')->name('school.')->group(function () {
    Route::get('/', Desktop::class)->name('index');
});

// * SETTINGS ROUTES * //
Route::get('/settings', Settings::class)->name('settings');








