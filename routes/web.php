<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DroneController;

// Route untuk halaman login
Route::get('/', function () {
    return view('login');
})->name('login');  

// Route Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Home Page (beranda admin)
Route::get('/home', [DroneController::class, 'index'])->name('home');

// Detail berdasarkan merk drone
Route::get('/merk/{id}', [DroneController::class, 'show'])->name('drone.details');

// Halaman untuk menambahkan drone (optional jika ada form manual)
Route::get('/addDrone', function () {
    // Jika ingin batasi hanya admin:
    if (!session('is_logged_in')) {
        return redirect('/login');
    }
    return view('addDrone');
});
