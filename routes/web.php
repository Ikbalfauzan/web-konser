<?php

use App\Http\Controllers\Admin\KonserController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\KonserController as UserKonserController;
use App\Http\Controllers\User\PemesananController;
use App\Http\Controllers\Admin\TiketController;
use App\Http\Controllers\Admin\PesananController;

// Landing page
Route::get('/', function () {
    return view('landing');
});

// Login dan registrasi
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Dashboard admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin-dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/users', [UserController::class, 'index'])
    ->name('admin.users.index');

Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])
    ->name('admin.users.destroy');
    Route::resource('/admin/konser', KonserController::class)
    ->names('admin.konser');
    Route::get('/admin/tiket', [TiketController::class, 'index'])
    ->name('admin.tiket.index');

Route::patch('/admin/tiket/{pemesanan}/status', [TiketController::class, 'updateStatus'])
    ->name('admin.tiket.updateStatus');
    Route::get('/admin/pesanan', [PesananController::class, 'index'])
    ->name('admin.pesanan.index');
});

// Dashboard user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user-dashboard');
    })->name('user.dashboard');
    Route::get('/user/konser', [UserKonserController::class, 'index'])
    ->name('user.konser.index');

Route::get('/user/konser/{konser}', [UserKonserController::class, 'show'])
    ->name('user.konser.show');
    
Route::post('/user/konser/{konser}/pesan', [PemesananController::class, 'store'])
    ->name('user.konser.pesan');

Route::get('/user/tiket-saya', [PemesananController::class, 'tiketSaya'])
    ->name('user.tiket.index');

Route::get('/user/riwayat-pesanan', [PemesananController::class, 'riwayat'])
    ->name('user.pemesanan.riwayat');

});