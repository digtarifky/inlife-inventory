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

// --------------------------------------------------------
// GRUP ROUTE YANG MEMBUTUHKAN LOGIN (Semua Role)
// --------------------------------------------------------
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard & Fitur AJAX (Bisa dilihat semua role)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/products/get-next-code', [ProductController::class, 'getNextCode'])->name('products.get_next_code');
    
    // Halaman List Utama & Detail (Bisa dilihat semua role)
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
    
    // Profile Routes bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --------------------------------------------------------
    // HAK AKSES ADMIN & STAFF (Kelola Inventaris & Peminjaman)
    // --------------------------------------------------------
    Route::middleware(['role:Admin,Staff'])->group(function () {
        // Kelola Kategori Master
        Route::resource('categories', CategoryController::class);
        
        Route::resource('products', ProductController::class)->except(['index', 'show']);
        
        Route::get('/borrowings/create', [BorrowingController::class, 'create'])->name('borrowings.create');
        Route::post('/borrowings', [BorrowingController::class, 'store'])->name('borrowings.store');
        Route::put('/borrowings/return/{detailId}', [BorrowingController::class, 'returnItem'])->name('borrowings.return_item');
    });
    // --------------------------------------------------------
    // HAK AKSES KHUSUS ADMIN (Full Access - Pengaturan Sistem)
    // --------------------------------------------------------
    Route::middleware(['role:Admin'])->group(function () {
        // Tempat manajemen user/role jika diperlukan nanti
    });

    // --------------------------------------------------------
    // HAK AKSES MANAGER & ADMIN (Melihat Laporan)
    // --------------------------------------------------------
    Route::middleware(['role:Admin,Manager'])->group(function () {
        // Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });

});

require __DIR__.'/auth.php';