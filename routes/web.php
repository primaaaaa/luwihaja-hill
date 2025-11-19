<?php

use App\Http\Controllers\AdminController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
// use Illuminate\Foundation\Application;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'Beranda'])->name('beranda');
Route::get('/beranda', [PageController::class, 'Beranda'])->name('beranda');
Route::get('/tentang', [PageController::class, 'Tentang'])->name('tentang');
Route::get('/kebijakan', [PageController::class, 'Kebijakan'])->name('kebijakan');


Route::get('/fasilitas', [PageController::class, 'Fasilitas'])->name('fasilitas');
Route::get('/galeri', [PageController::class, 'Galeri'])->name('galeri');


Route::middleware('auth')->group(function () {
    Route::get('/booking', [PageController::class, 'Booking'])->name('booking');
    Route::get('/pembayaransukses', [PageController::class, 'pembayaranSukses'])->name('pembayaransukses');
    Route::get('/riwayatpembayaran', [PageController::class, 'riwayatpembayaran'])->name('riwayatpembayaran');
    Route::get('/riwayatreservasi', [PageController::class, 'riwayatreservasi'])->name('riwayatreservasi');
    Route::get('/akomodasi', [PageController::class, 'Akomodasi'])->name('akomodasi');
    Route::get('/detailakomodasi', [PageController::class, 'detailAkomodasi'])->name('detailakomodasi');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Rute Admin
Route::middleware('check.is.admin')
->prefix('admin')
->name('admin.')
->group(function ()
{
    Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('dashboard');
    Route::get('/kamar', [AdminController::class, 'Kamar'])->name('manajemenkamar');
    Route::get('/reservasi', [AdminController::class, 'Reservasi'])->name('manajemenreservasi');
    Route::get('/ulasan', [AdminController::class, 'Ulasan'])->name('manajemenulasan');
    Route::get('/cms', [AdminController::class, 'CMS'])->name('cms');
    Route::get('/refund', [AdminController::class, 'Refund'])->name('manajemenrefund');
    Route::get('/pembayaran', [AdminController::class, 'Pembayaran'])->name('manajemenpembayaran');
    Route::get('/kamar-detail', [AdminController::class, 'DetailKamar'])->name(name: 'kamar-detail');
    Route::get('/pembayaran-detail', [AdminController::class, 'DetailPembayaran'])->name('pembayaran-detail');
    Route::get('/refund-detail', [AdminController::class, 'DetailRefund'])->name('refund-detail');
    Route::get('/reservasi-detail', [AdminController::class, 'DetailReservasi'])->name('reservasi-detail');
    Route::get('/ulasan-detail', [AdminController::class, 'DetailUlasan'])->name('ulasan-detail');
});

