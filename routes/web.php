<?php

use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index'])->name('index');
Route::get('/login', [LandingController::class, 'login'])->name('login.form');
Route::post('/login', [LandingController::class, 'proses_login'])->name('login');
Route::get('/register', [LandingController::class, 'register'])->name('register.form');
Route::post('/register', [LandingController::class, 'proses_register'])->name('register');
Route::post('/logout', [LandingController::class, 'logout'])->name('logout');
Route::get('/cerita', [LandingController::class, 'cerita'])->name('cerita');
Route::get('/cerita/{cerita}', [LandingController::class, 'detail'])->name('detail');


Route::middleware('auth')->group(function () { 
    Route::get('/profile', [LandingController::class, 'profile'])->name('profile');
    Route::get('/profile/update', [LandingController::class, 'update_profile'])->name('profile.form');
    Route::post('/profile/update', [LandingController::class, 'proses_update_profile'])->name('profile.update');
    Route::get('/dashboard', [LandingController::class, 'index'])->name('dashboard');
});