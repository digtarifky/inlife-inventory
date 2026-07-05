<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BorrowingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

// Grup Route yang membutuhkan Login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Semua role bisa melihat Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    
    // Profile Routes bawaan Breeze (Semua role)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --------------------------------------------------------
    // HAK AKSES ADMIN & STAFF (Kelola Inventaris & Peminjaman)
    // --------------------------------------------------------
    Route::middleware(['role:Admin,Staff'])->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('borrowings', BorrowingController::class);
    });

    // --------------------------------------------------------
    // HAK AKSES KHUSUS ADMIN (Full Access - Fitur Ekstra Nanti)
    // --------------------------------------------------------
    Route::middleware(['role:Admin'])->group(function () {
        // Route khusus pengaturan sistem/user manajemen bisa diletakkan di sini nantinya
    });

    // --------------------------------------------------------
    // HAK AKSES MANAGER & ADMIN (Melihat Laporan)
    // --------------------------------------------------------
    Route::middleware(['role:Admin,Manager'])->group(function () {
        // Route khusus untuk mengunduh laporan PDF/Excel
        // Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });

});
require __DIR__.'/auth.php';