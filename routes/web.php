<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DroneController;

// Route untuk halaman login
Route::get('/', function () {
    return view('login');
})->name('login');  

// Route untuk halaman home menampilkan merk-merk drone
Route::get('/home', [DroneController::class, 'index'])->name('home');

// Route untuk halaman details
Route::get('/drones/{id}', [DroneController::class, 'show'])->name('drones.show');

// Route untuk halaman addDrone
Route::get('/addDrone', function () {
    return view('addDrone');
});


