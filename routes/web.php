<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', [LandingpageController::class, 'home'])->name('home');
Route::get('/beli/{id}', [LandingpageController::class, 'beli'])->name('beli');
Route::get('/produk/{id}', [LandingpageController::class, 'detail'])
    ->name('produk.detail');






Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');
Route::get('/pesanan', [AdminController::class, 'pesanan'])->name('pesanan');
Route::get('/elektronik', [AdminController::class, 'elektronik'])->name('elektronik');
Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');