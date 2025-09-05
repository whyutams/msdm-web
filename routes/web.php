<?php

use App\Http\Controllers\CeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KontakSebayaController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
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

Route::get('/logout', function () {
    return abort(404, 'Not Found');
});
Route::middleware('auth')->post('/logout', [LandingController::class, 'logout'])->name('logout');

Route::middleware(['check.biodata', 'check.suspended'])->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('index');
    Route::get('/cerita', [CeritaController::class, 'index'])->name('cerita');
    Route::get('/cerita/add', [CeritaController::class, 'create'])->name('cerita.add')->middleware(['auth', 'role:' . User::ROLE_USER]);
    Route::post('/cerita/add', [CeritaController::class, 'store'])->name('cerita.add.submit')->middleware(['auth', 'role:' . User::ROLE_USER]);
    Route::get('/cerita/{cerita}', [CeritaController::class, 'show'])->name('cerita.show');
    Route::get('/cerita/{cerita}/edit', [CeritaController::class, 'edit'])->name('cerita.edit')->middleware(['auth', 'role:' . User::ROLE_USER]);
    Route::post('/cerita/{cerita}/edit', [CeritaController::class, 'update'])->name('cerita.edit.submit')->middleware(['auth', 'role:' . User::ROLE_USER]);
    Route::post('/cerita/{cerita}/delete', [CeritaController::class, 'destroy'])->name('cerita.delete')->middleware(['auth', 'role:' . User::ROLE_USER]);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LandingController::class, 'login'])->name('login.form');
    Route::post('/login', [LandingController::class, 'proses_login'])->name('login');
    Route::get('/register', [LandingController::class, 'register'])->name('register.form');
    Route::post('/register', [LandingController::class, 'proses_register'])->name('register');
});

Route::middleware(['auth', 'check.suspended'])->group(function () {
    Route::get('/biodata/edit', [ProfileController::class, 'biodata_edit'])->name('biodata.edit');
    Route::post('/biodata/update', [ProfileController::class, 'biodata_update'])->name('biodata.update');

    Route::middleware(['role:' . User::ROLE_USER, 'check.biodata'])->group(function () {
        Route::get('/mytask', [ProfileController::class, 'task'])->name('task');
        Route::get('/kelas-sebaya', [LandingController::class, 'kelas_sebaya'])->name('kelas-sebaya');
        Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    });

    Route::get('/profile/update', [ProfileController::class, 'update_profile'])->name('profile.form');
    Route::post('/profile/update', [ProfileController::class, 'proses_update_profile'])->name('profile.update');

    Route::prefix('/dashboard')->name('dashboard.')->middleware(['role:' . User::ROLE_SUPERADMIN . ',' . User::ROLE_ADMIN])->group(function () {
        Route::get('', [DashboardController::class, 'index'])->name('index');
        Route::resource('/kontak_sebaya', KontakSebayaController::class)->only(['create', 'update', 'store', 'edit', 'destroy'])->names('kontak_sebaya')->middleware('role:' . User::ROLE_ADMIN);
        Route::resource('/kontak_sebaya', KontakSebayaController::class)->only(['index'])->names('kontak_sebaya')->middleware('role:' . User::ROLE_SUPERADMIN . ',' . User::ROLE_ADMIN);
        Route::post('/users/suspend/{user}', [UserController::class, 'toggleSuspend'])->name('users.suspend')->middleware('role:' . User::ROLE_SUPERADMIN);
        Route::resource('/users', UserController::class)->only(['create', 'update', 'store', 'edit', 'destroy'])->names('users')->middleware(['role:' . User::ROLE_SUPERADMIN]);
        Route::resource('/users', UserController::class)->only(['index', 'show'])->names('users')->middleware(['role:' . User::ROLE_SUPERADMIN . ',' . User::ROLE_ADMIN]);
        Route::get('/cerita', [CeritaController::class, 'd_index'])->name('cerita.index');
        Route::get('/cerita/{cerita}', [CeritaController::class, 'd_show'])->name('cerita.show');
    });
});