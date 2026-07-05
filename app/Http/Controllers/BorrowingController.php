<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    /**
     * Menampilkan daftar Riwayat Peminjaman.
     */
    public function index(): View
    {
        // Mengambil data peminjaman beserta relasi user dan product (Eager Loading)
        $borrowings = Borrowing::with(['user', 'product'])
            ->latest('borrow_date')
            ->paginate(10);

        return view('borrowings.index', compact('borrowings'));
    }

    /**
     * Menampilkan formulir Tambah Peminjaman.
     */
    public function create(): View
    {
        // Hanya menampilkan barang yang memiliki stok di atas 0
        $products = Product::where('stock', '>', 0)->get();
        
        return view('borrowings.create', compact('products'));
    }

    /**
     * Menyimpan data peminjaman baru & Mengurangi stok secara otomatis.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'borrow_date' => ['required', 'date'],
        ]);

        $product = Product::findOrFail($validated['product_id']);

        // Proteksi Tambahan: Pastikan stok benar-benar tersedia sebelum diproses
        if ($product->stock < 1) {
            return back()->withErrors(['product_id' => 'Stok barang ini sedang kosong dan tidak dapat dipinjam.']);
        }

        // 1. Simpan Transaksi Peminjaman (user_id otomatis dari admin/staff yang login)
        Borrowing::create([
            'user_id' => Auth::id(),
            'product_id' => $validated['product_id'],
            'borrow_date' => $validated['borrow_date'],
            'status' => 'Dipinjam'
        ]);

        // 2. Potong Stok Barang secara Otomatis
        $product->decrement('stock', 1);

        return redirect()->route('borrowings.index')
            ->with('success', "Peminjaman barang {$product->name} berhasil dicatat. Stok berkurang 1.");
    }

    /**
     * Memproses Pengembalian Barang & Mengembalikan stok secara otomatis.
     */
    public function returnProduct(Borrowing $borrowing): RedirectResponse
    {
        // Pastikan barang memang berstatus Dipinjam sebelum dikembalikan
        if ($borrowing->status === 'Dikembalikan') {
            return back()->with('error', 'Barang ini sudah dikembalikan sebelumnya.');
        }

        // 1. Perbarui status peminjaman dan catat tanggal hari ini
        $borrowing->update([
            'status' => 'Dikembalikan',
            'return_date' => now()->format('Y-m-d')
        ]);

        // 2. Tambahkan kembali stok barang tersebut
        $borrowing->product->increment('stock', 1);

        return redirect()->route('borrowings.index')
            ->with('success', "Barang {$borrowing->product->name} telah berhasil dikembalikan. Stok bertambah 1.");
    }
}
