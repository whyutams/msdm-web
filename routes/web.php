<?php

use App\Http\Controllers\CeritaController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Http\Exceptions\NotFound;

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
Route::get('/logout', function () {
    return abort(404, 'Not Found'); });
Route::post('/logout', [LandingController::class, 'logout'])->name('logout');
Route::get('/cerita', [CeritaController::class, 'index'])->name('cerita');
Route::get('/cerita/add', [CeritaController::class, 'create'])->name('cerita.add')->middleware('auth');
Route::post('/cerita/add', [CeritaController::class, 'store'])->name('cerita.add.submit')->middleware('auth');
Route::get('/cerita/{cerita}', [CeritaController::class, 'show'])->name('cerita.show');
Route::get('/cerita/{cerita}/edit', [CeritaController::class, 'edit'])->name('cerita.edit')->middleware('auth');
Route::post('/cerita/{cerita}/edit', [CeritaController::class, 'update'])->name('cerita.edit.submit')->middleware('auth');
Route::post('/cerita/{cerita}/delete', [CeritaController::class, 'destroy'])->name('cerita.delete')->middleware('auth');
Route::get('/kelas-sebaya', [LandingController::class, 'kelas_sebaya'])->name('kelas-sebaya');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LandingController::class, 'login'])->name('login.form');
    Route::post('/login', [LandingController::class, 'proses_login'])->name('login');
    Route::get('/register', [LandingController::class, 'register'])->name('register.form');
    Route::post('/register', [LandingController::class, 'proses_register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile/update', [ProfileController::class, 'update_profile'])->name('profile.form');
    Route::post('/profile/update', [ProfileController::class, 'proses_update_profile'])->name('profile.update');
    Route::get('/mytask', [ProfileController::class, 'task'])->name('task');

    Route::get('/dashboard', [LandingController::class, 'index'])->name('dashboard');
});