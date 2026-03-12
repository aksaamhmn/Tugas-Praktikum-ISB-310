<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Rute untuk Halaman Utama & Kelola
Route::get('/', [AuthController::class, 'index']);
Route::get('/kelola', [AuthController::class, 'kelola']);

// Rute untuk Autentikasi (Login & Logout)
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
