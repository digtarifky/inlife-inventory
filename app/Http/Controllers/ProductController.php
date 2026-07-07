<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar semua barang inventaris.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                // Mengelompokkan fitur search
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($catQuery) use ($search) {
                            $catQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->oldest()
            ->paginate(10)
            ->withQueryString();

        $lowStockProducts = Product::where('stock', '<=', 5)->get();
    return view('products.index', compact('products', 'search', 'lowStockProducts'));
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'code'        => 'required|unique:products',
            'name'        => 'required|string|max:255',
            'stock'       => 'required|integer|min:0',
            'storage_location' => 'required|string|max:255',
            'condition'   => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail spesifik satu barang.
     */
    public function show(Product $product): View
    {
        return view('products.detail', compact('product'));
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
     * Membuat kode inventaris otomatis berdasarkan kategori yang dipilih (AJAX).
     */
    public function getNextCode(Request $request): JsonResponse
    {
        $category = Category::find($request->category_id);

        if (!$category) {
            return response()->json(['code' => '']);
        }

        $name = strtoupper($category->name);
        if (str_contains($name, 'ELEKTRONIK')) $prefix = 'ELK';
        elseif (str_contains($name, 'FURNITUR')) $prefix = 'FTR';
        elseif (str_contains($name, 'KENDARAAN')) $prefix = 'KNO';
        elseif (str_contains($name, 'KEBERSIHAN')) $prefix = 'AKB';
        elseif (str_contains($name, 'KANTOR')) $prefix = 'AKT';
        else {
            $prefix = substr(preg_replace('/[^A-Z]/', '', $name), 0, 3);
        }

        $latestProduct = Product::where('code', 'like', "INV-{$prefix}-%")->orderBy('code', 'desc')->first();

        $nextNumber = 1;
        if ($latestProduct) {
            $lastNumber = intval(substr($latestProduct->code, -3));
            $nextNumber = $lastNumber + 1;
        }

        $nextCode = "INV-{$prefix}-" . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return response()->json(['code' => $nextCode]);
    }

    /**
     * Memperbarui data barang yang sudah ada di database.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'code'        => 'required|unique:products,code,' . $product->id,
            'name'        => 'required|string|max:255',
            'stock'       => 'required|integer|min:0',
            'storage_location' => 'nullable|string|max:255',
            'condition'   => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Barang berhasil diperbarui!');
    }

    /**
     * Menghapus data barang dari sistem.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Barang berhasil dihapus!');
    }
}
