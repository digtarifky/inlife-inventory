<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar semua barang inventaris.
     */
    public function index(): View
    {
        // Mengambil produk beserta data kategori terkaitnya (Eager Loading untuk performa)
        $products = Product::with('category')->latest()->get();
        return view('products.index', compact('products'));
    }

    /**
     * Menampilkan formulir tambah barang baru.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Menyimpan data barang baru ke database dengan validasi ketat.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'unique:products,code', 'max:50'],
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ], [
            'code.unique' => 'Kode barang sudah terdaftar di sistem! Gunakan kode unik lain.',
            'stock.min' => 'Stok tidak boleh bernilai negatif.'
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Barang inventaris baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan formulir edit data barang.
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Memperbarui data barang yang sudah ada di database.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:products,code,' . $product->id],
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ], [
            'code.unique' => 'Kode barang sudah digunakan oleh aset lain.',
            'stock.min' => 'Stok tidak boleh bernilai negatif.'
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Data barang inventaris berhasil diperbarui.');
    }

    /**
     * Menghapus data barang dari sistem.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Barang inventaris berhasil dihapus dari sistem.');
    }
}