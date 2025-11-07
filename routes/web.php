<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

Route::get('/beranda', [PageController::class, 'Beranda'])->name('beranda');
Route::get('/tentang', [PageController::class, 'Tentang'])->name('tentang');
Route::get('/kebijakan', [PageController::class, 'Kebijakan'])->name('kebijakan');
Route::get('/akomodasi', [PageController::class, 'Akomodasi'])->name('akomodasi');
Route::get('/fasilitas', [PageController::class, 'Fasilitas'])->name('fasilitas');
Route::get('/galeri', [PageController::class, 'Galeri'])->name('galeri');

// require __DIR__.'/auth.php';
