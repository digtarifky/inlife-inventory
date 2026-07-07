<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Menampilkan semua data barang (GET /api/products)
     */
    public function index()
    {
        // Mengambil semua produk beserta nama kategorinya
        $products = Product::with('category:id,name')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data barang berhasil diambil',
            'data'    => $products
        ], 200);
    }

    /**
     * Menampilkan detail satu barang berdasarkan ID (GET /api/products/{id})
     */
    public function show($id)
    {
        $product = Product::with('category:id,name')->find($id);

        if ($product) {
            return response()->json([
                'success' => true,
                'message' => 'Detail barang berhasil ditemukan',
                'data'    => $product
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data barang tidak ditemukan',
                'data'    => null
            ], 404);
        }
    }
}