<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\BorrowingDetail;
use Illuminate\View\View;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(): View
    {
        // 1. Kalkulasi Total Barang (Jenis & Fisik)
        $totalTypes = Product::count();
        $totalStock = Product::sum('stock');

        // 2. Kalkulasi Barang Tersedia (Jenis & Fisik)
        $availableTypes = Product::where('stock', '>', 0)->count();
        $availableStock = Product::where('stock', '>', 0)->sum('stock');

        // 3. Kalkulasi Barang Dipinjam (Jumlah item fisik yang keluar)
        $borrowedItems = BorrowingDetail::where('item_status', 'Dipinjam')->count();

        // 4. Meracik Data Grafik
        $currentYear = \Carbon\Carbon::now()->year;
        
        $monthlyData = BorrowingDetail::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $chartData = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $monthlyData[$i] ?? 0;
        }

        return view('dashboard', compact(
            'totalTypes',
            'totalStock',
            'availableTypes',
            'availableStock',
            'borrowedItems', 
            'chartData', 
            'months',
            'currentYear'
        ));
    }
}