<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

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
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('code', 'like', "%{$search}%");
            })
            ->oldest()
            ->paginate(10)
            ->withQueryString();
        
        return view('products.index', compact('products', 'search'));
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
     * Menampilkan detail spesifik satu barang.
     */
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
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

        // Tentukan Prefix (Awalan) berdasarkan nama kategori
        $name = strtoupper($category->name);
        if (str_contains($name, 'ELEKTRONIK')) $prefix = 'ELK';
        elseif (str_contains($name, 'FURNITUR')) $prefix = 'FTR';
        elseif (str_contains($name, 'KENDARAAN')) $prefix = 'KNO';
        elseif (str_contains($name, 'KEBERSIHAN')) $prefix = 'AKB';
        elseif (str_contains($name, 'KANTOR')) $prefix = 'AKT';
        else {
            // Fallback: Ambil 3 huruf pertama konsonan
            $prefix = substr(preg_replace('/[^A-Z]/', '', $name), 0, 3);
        }

        // Cari nomor urut terakhir untuk prefix ini
        $latestProduct = Product::where('code', 'like', "INV-{$prefix}-%")->orderBy('code', 'desc')->first();
        
        $nextNumber = 1;
        if ($latestProduct) {
            // Ambil 3 angka terakhir dan tambahkan 1
            $lastNumber = intval(substr($latestProduct->code, -3));
            $nextNumber = $lastNumber + 1;
        }

        // Format hasil akhir (Contoh: INV-ELK-006)
        $nextCode = "INV-{$prefix}-" . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return response()->json(['code' => $nextCode]);
    }

    /**
     * Memperbarui data barang yang sudah ada di database.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            // Validasi 'code' dihapus karena sudah dikunci dan tidak boleh diubah
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ], [
            'stock.min' => 'Stok tidak boleh bernilai negatif.'
        ]);

        // Update data, tanpa menyertakan 'code'
        $product->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'stock' => $validated['stock'],
            'description' => $validated['description'] ?? '',
        ]);

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