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
Route::get('/admin/kamar', [AdminController::class, 'Kamar'])->name('manajemenkamar');
Route::get('/admin/reservasi', [AdminController::class, 'Reservasi'])->name('manajemenreservasi');
Route::get('/admin/ulasan', [AdminController::class, 'Ulasan'])->name('manajemenulasan');
Route::get('/admin/cms', [AdminController::class, 'CMS'])->name('cms');
Route::get('/admin/refund', [AdminController::class, 'Refund'])->name('manajemenrefund');
Route::get('/admin/pembayaran', [AdminController::class, 'Pembayaran'])->name('manajemenpembayaran');
Route::get('/admin/kamar-detail/{kamar:kode_tipe}', [AdminController::class, 'DetailKamar'])->name(name: 'kamar-detail');
Route::get('/admin/pembayaran-detail', [AdminController::class, 'DetailPembayaran'])->name('pembayaran-detail');
Route::get('/admin/refund-detail', [AdminController::class, 'DetailRefund'])->name('refund-detail');
Route::get('/admin/reservasi-detail', [AdminController::class, 'DetailReservasi'])->name('reservasi-detail');
Route::get('/admin/ulasan-detail', [AdminController::class, 'DetailUlasan'])->name('ulasan-detail');
// require __DIR__.'/auth.php';
