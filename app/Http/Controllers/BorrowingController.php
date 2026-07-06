<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function index(): View
    {
        $activeItems = BorrowingDetail::with(['borrowing.user', 'product'])
            ->where('item_status', 'Dipinjam')
            ->orderByDesc('created_at')
            ->get();


        $completedItems = BorrowingDetail::with(['borrowing.user', 'product'])
            ->where('item_status', 'Dikembalikan')
            ->orderByDesc('return_date')
            ->paginate(10);

        return view('borrowings.index', compact('activeItems', 'completedItems'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi: product_ids sekarang adalah array (bisa pilih banyak barang)
        $request->validate([
            'borrow_date' => ['required', 'date'],
            'product_ids' => ['required', 'array'],
            'product_ids.*' => ['exists:products,id']
        ]);

        try {
            // Gunakan Transaction agar aman dari gagal simpan di tengah jalan
            DB::transaction(function () use ($request) {
                
                // 1. Buat Nota Payung (Master)
                $borrowing = Borrowing::create([
                    'user_id' => Auth::id(),
                    'borrow_date' => $request->borrow_date,
                    'status' => 'Berjalan'
                ]);

                // 2. Looping setiap barang yang dipilih ke dalam Detail (Keranjang)
                foreach ($request->product_ids as $productId) {
                    $product = Product::lockForUpdate()->findOrFail($productId);
                    
                    if ($product->stock > 0) {
                        BorrowingDetail::create([
                            'borrowing_id' => $borrowing->id,
                            'product_id' => $productId,
                            'item_status' => 'Dipinjam'
                        ]);
                        
                        // Potong stok
                        $product->decrement('stock', 1);
                    }
                }
            });

            return redirect()->route('borrowings.index')->with('success', 'Transaksi peminjaman berhasil dicatat dan stok telah dipotong.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memproses peminjaman: ' . $e->getMessage());
        }
    }

    public function create(): View
    {
        $products = Product::where('stock', '>', 0)->get();
        
        return view('borrowings.create', compact('products'));
    }

    /**
     * Memproses Pengembalian per Barang (Bukan per Transaksi)
     */
    public function returnItem($detailId): RedirectResponse
    {
        $detail = BorrowingDetail::findOrFail($detailId);

        if ($detail->item_status === 'Dikembalikan') {
            return back()->with('error', 'Barang ini sudah dikembalikan.');
        }

        DB::transaction(function () use ($detail) {
            $detail->update([
                'item_status' => 'Dikembalikan',
                'return_date' => now()->format('Y-m-d')
            ]);

            $detail->product->increment('stock', 1);

            $borrowing = $detail->borrowing;
            $allReturned = $borrowing->details()->where('item_status', 'Dipinjam')->count() === 0;
            
            if ($allReturned) {
                $borrowing->update(['status' => 'Selesai']);
            }
        });

        return redirect()->route('borrowings.index')->with('success', 'Barang berhasil dikembalikan dan stok telah ditambahkan.');
    }
}