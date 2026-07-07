<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BorrowingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Halaman List Utama (Bisa dilihat semua role)
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --------------------------------------------------------
    // HAK AKSES ADMIN & STAFF (Aku kembalikan menggunakan koma)
    // --------------------------------------------------------
    Route::middleware(['role:Admin,Staff'])->group(function () {
        Route::resource('categories', CategoryController::class);
        
        // PENTING: get-next-code ditaruh di atas agar aman
        Route::get('/products/get-next-code', [ProductController::class, 'getNextCode'])->name('products.get_next_code');
        
        // Resource ditaruh di sini agar /products/create terbaca dengan benar
        Route::resource('products', ProductController::class)->except(['index', 'show']);
        
        // Peminjaman
        Route::get('/borrowings/create', [BorrowingController::class, 'create'])->name('borrowings.create');
        Route::post('/borrowings', [BorrowingController::class, 'store'])->name('borrowings.store');
        Route::put('/borrowings/return/{detailId}', [BorrowingController::class, 'returnItem'])->name('borrowings.return_item');
    });

    // PENTING: route 'show' ditaruh di BAWAH resource agar tidak menabrak URL 'create'
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    

    // --------------------------------------------------------
    // HAK AKSES MANAGER & ADMIN (Export Laporan)
    // --------------------------------------------------------
    Route::middleware(['role:Admin,Manager'])->group(function () {
        Route::get('/export/excel', [ReportController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [ReportController::class, 'exportPdf'])->name('export.pdf');
    });

});

require __DIR__.'/auth.php';