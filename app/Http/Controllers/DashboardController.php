<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung statistik untuk widget dashboard sesuai kebutuhan bisnis
        $totalBarang = Product::count(); // Total Barang [cite: 75]
        $barangDipinjam = Product::where('stock', 0)->count(); // Contoh logika sederhana Barang Dipinjam [cite: 76]
        $barangTersedia = Product::where('stock', '>', 0)->count(); // Barang Tersedia [cite: 77]

        // Kirim data ke view dashboard
        return view('dashboard', compact('totalBarang', 'barangDipinjam', 'barangTersedia'));
    }
}