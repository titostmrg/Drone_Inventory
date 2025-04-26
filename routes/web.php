<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk halaman login
Route::get('/login', function () {
    return view('login');
})->name('login');  

// Route untuk halaman home
Route::get('/home', function () {
    return view('home');
})->name('home');

// Route untuk halaman details
Route::get('/details', function () {
    return view('details');
});

// Route untuk halaman addDrone
Route::get('/addDrone', function () {
    return view('addDrone');
});
