<?php

use App\Livewire\Desktop;
use App\Livewire\Dashboard;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// ! OPEN ROUTES ! //
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












// ! GUEST ROUTES ! //
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

// ! AUTHENTICATED ROUTES ! //
Route::middleware('auth')->group(function () {
    //
});

// ! DEBUGGING DEVELOPMENT ROUTES ! //
if (app()->environment('local')) {
    Route::get('/clear', function () {
        Artisan::call('optimize:clear');
        Auth::logout();
        return redirect()->route('desktop');
    });
}
