<?php

use App\Http\Controllers\AdminController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
// use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;



Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

Route::get('/beranda', [PageController::class, 'Beranda'])->name('beranda');
Route::get('/tentang', [PageController::class, 'Tentang'])->name('tentang');
Route::get('/kebijakan', [PageController::class, 'Kebijakan'])->name('kebijakan');

Route::get('/akomodasi', [PageController::class, 'Akomodasi'])->name('akomodasi');
Route::get('/detailakomodasi', [PageController::class, 'detailAkomodasi'])->name('detailakomodasi');
Route::get('/booking', [PageController::class, 'Booking'])->name('booking');
Route::get('/pembayaransukses', [PageController::class, 'pembayaranSukses'])->name('pembayaransukses');
Route::get('/riwayatpembayaran', [PageController::class, 'riwayatpembayaran'])->name('riwayatpembayaran');
Route::get('/riwayatreservasi', [PageController::class, 'riwayatreservasi'])->name('riwayatreservasi');



Route::get('/fasilitas', [PageController::class, 'Fasilitas'])->name('fasilitas');
Route::get('/galeri', [PageController::class, 'Galeri'])->name('galeri');


Route::get('/', [PageController::class, 'Beranda'])->name('beranda');


// Rute Admin
Route::get('/admin/dashboard', [AdminController::class, 'Dashboard'])->name('dashboard');
Route::get('/admin/kamar', [AdminController::class, 'Kamar'])->name('dashboard');
Route::get('/admin/reservasi', [AdminController::class, 'Reservasi'])->name('dashboard');
Route::get('/admin/ulasan', [AdminController::class, 'Ulasan'])->name('dashboard');
// require __DIR__.'/auth.php';
