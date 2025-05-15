<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DroneController;
use App\Http\Controllers\DroneMerkController;

// Route untuk halaman login
Route::get('/', function () {
    return view('login');
})->name('login');  

// Route Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Tampilkan form tambah merk
Route::get('/merk/create', [DroneController::class, 'createMerk'])->name('merk.create');

// Simpan data merk baru
Route::post('/merk', [DroneMerkController::class, 'storeMerk'])->name('merk.store');

// Menambahkan drone dengan merk tertentu
Route::post('/drone', [DroneController::class, 'store'])->name('drone.store');

//Mengedit drone pada halaman details drone
Route::put('/drone/{id}', [DroneController::class, 'update'])->name('drone.update');

//Mengupdate data drone
Route::put('/drone/{id}', [DroneController::class, 'update'])->name('drone.update');

//Menghapus data drone 
Route::delete('/drone/{id}', [DroneController::class, 'destroy'])->name('drone.destroy');

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
