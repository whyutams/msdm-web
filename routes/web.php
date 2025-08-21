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
Route::get('/login', [LandingController::class, 'login'])->name('login');
Route::get('/register', [LandingController::class, 'register'])->name('register');
Route::get('/cerita', [LandingController::class, 'cerita'])->name('cerita');
Route::get('/cerita/{cerita}', [LandingController::class, 'detail'])->name('detail');
