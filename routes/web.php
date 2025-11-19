<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('role:Admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('dashboard');
        Route::get('/kamar', [AdminController::class, 'Kamar'])->name('manajemenkamar');
        Route::get('/kamar', [AdminController::class, 'Kamar'])->name('admin.kamar');
        Route::get('/kamar-detail/{id:kode_tipe}', [AdminController::class, 'detailKamar'])->name('admin.kamar-detail');
        Route::post('/kamar/store', [AdminController::class, 'storeKamar'])->name('admin.kamar.store');
        Route::put('/kamar/update/{id}', [AdminController::class, 'updateKamar'])->name('admin.kamar.update');
        Route::patch('/kamar/status/{id}', [AdminController::class, 'updateStatusKamar'])->name('admin.kamar.status');
        Route::delete('/kamar/delete/{id}', [AdminController::class, 'deleteKamar'])->name('admin.kamar.delete');
        Route::get('/reservasi', [AdminController::class, 'reservasi'])->name('manajemenreservasi');
        Route::put('/reservasi/update-status/{id}', [AdminController::class, 'updateStatusReservasi'])->name('admin.reservasi.update-status');
        Route::delete('/reservasi/delete/{id}', [AdminController::class, 'deleteReservasi'])->name('admin.reservasi.delete');
        Route::get('/reservasi-detail/{id}', [AdminController::class, 'DetailReservasi'])->name('reservasi-detail');
        Route::get('/ulasan', [AdminController::class, 'Ulasan'])->name('manajemenulasan');
        Route::get('/ulasan/detail/{id}', [AdminController::class, 'DetailUlasan'])->name('ulasan-detail');
        Route::get('/cms', [AdminController::class, 'CMS'])->name('cms');
        Route::post('/cms/upload', [AdminController::class, 'storeGaleri'])->name('cms.upload');
        Route::delete('/cms/delete/{id}', [AdminController::class, 'deleteGaleri'])->name('cms.delete');
        Route::get('/refund', [AdminController::class, 'Refund'])->name('manajemenrefund');
        Route::get('/pembayaran', [AdminController::class, 'Pembayaran'])->name('manajemenpembayaran');
        Route::post('pembayaran/{id}/update-status', [AdminController::class, 'updateStatusPembayaran'])->name('pembayaran-update-status');
        Route::get('/pembayaran-detail/{id}', [AdminController::class, 'DetailPembayaran'])->name('pembayaran-detail');
        Route::get('/kamar-detail', [AdminController::class, 'DetailKamar'])->name('kamar-detail');
        Route::get('/refund-detail', [AdminController::class, 'DetailRefund'])->name('refund-detail');
    });

    Route::get('/booking', [PageController::class, 'Booking'])->name('booking')->middleware('auth');
    Route::post('/booking/store', [PageController::class, 'storeBooking'])->name('booking.store')->middleware('auth');
    Route::get('/pembayaransukses/{id}', [PageController::class, 'pembayaranSukses'])->name('pages.pembayaransukses');
    Route::get('/riwayatpembayaran', [PageController::class, 'riwayatpembayaran'])->name('riwayatpembayaran');
    Route::get('/riwayatreservasi', [PageController::class, 'riwayatreservasi'])->name('riwayatreservasi');

    Route::post('/ulasan/store', [PageController::class, 'storeUlasan'])->name('ulasan.store');
});

Route::get('/', [PageController::class, 'Beranda'])->name('beranda');
Route::get('/beranda', [PageController::class, 'Beranda']);
Route::get('/tentang', [PageController::class, 'Tentang'])->name('tentang');
Route::get('/kebijakan', [PageController::class, 'Kebijakan'])->name('kebijakan');
Route::get('/akomodasi', [PageController::class, 'Akomodasi'])->name('akomodasi');
Route::get('/detailakomodasi/{id}', [PageController::class, 'detailAkomodasi'])->name('detailakomodasi');
Route::post('/check-availability', [PageController::class, 'checkAvailability'])->name('check.availability');
Route::get('/fasilitas', [PageController::class, 'Fasilitas'])->name('fasilitas');
Route::get('/galeri', [PageController::class, 'Galeri'])->name('galeri');
