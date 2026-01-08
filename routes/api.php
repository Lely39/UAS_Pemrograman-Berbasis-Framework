<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ElektronikController;
use App\Http\Controllers\Api\PesananController;


// Elektronik
Route::apiResource('elektronik', ElektronikController::class);
// Pesanan
Route::apiResource('pesanan', PesananController::class);
