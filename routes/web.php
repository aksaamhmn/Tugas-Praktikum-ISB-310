<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

// Rute Halaman Utama
Route::get('/', [ProductController::class, 'index']);

// Rute Kelola Data (Menampilkan Form & Menyimpan Data)
Route::get('/kelola', [ProductController::class, 'kelola']);
Route::post('/kelola', [ProductController::class, 'store']);

// Rute Autentikasi
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
