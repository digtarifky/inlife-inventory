<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Fitur Pencarian Barang
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('product_code', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'product_code' => 'required|unique:products,product_code',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'location' => 'required|string|max:255',
            'condition' => 'required|string|in:Baik,Rusak',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}