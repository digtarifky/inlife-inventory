<x-app-layout>
    <div class="py-8 bg-slate-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-6">
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-700 mb-4 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Kembali ke Daftar Barang
                </a>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Tambah Barang Baru</h1>
                <p class="text-sm text-slate-400 mt-1">Masukkan detail spesifikasi aset logistik ke dalam sistem.</p>
            </div>

            <div
                class="bg-white rounded-[28px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 p-8">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="code" class="block text-sm font-semibold text-slate-700 mb-2">Kode
                                Inventaris</label>
                            <input type="text" name="code" id="code" value="{{ old('code') }}"
                                class="block w-full px-4 py-3.5 bg-slate-100 border-transparent text-sm text-slate-500 font-medium cursor-not-allowed focus:ring-0"
                                placeholder="Pilih kategori terlebih dahulu" readonly required>
                            @error('code')
                                <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-2">Kategori
                                Barang</label>
                            <select name="category_id" id="category_id"
                                class="block w-full px-4 py-3.5 bg-slate-50 border-transparent focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-200 rounded-2xl text-sm text-slate-700 transition-all"
                                required>
                                <option value="" disabled selected>Pilih Kategori...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nama
                                Barang</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="block w-full px-4 py-3.5 bg-slate-50 border-transparent focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-200 rounded-2xl text-sm text-slate-700 placeholder-slate-400 transition-all"
                                placeholder="Masukkan nama komoditas" required>
                            @error('name')
                                <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="stock" class="block text-sm font-semibold text-slate-700 mb-2">Jumlah
                                Stok</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}"
                                min="0"
                                class="block w-full px-4 py-3.5 bg-slate-50 border-transparent focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-200 rounded-2xl text-sm text-slate-700 transition-all"
                                required>
                            @error('stock')
                                <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-8">
                        <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi
                            Barang (Opsional)</label>
                        <textarea name="description" id="description" rows="4"
                            class="block w-full px-4 py-3.5 bg-slate-50 border-transparent focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-200 rounded-2xl text-sm text-slate-700 placeholder-slate-400 transition-all resize-none"
                            placeholder="Tuliskan spesifikasi atau keterangan tambahan...">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                        <a href="{{ route('products.index') }}"
                            class="px-5 py-2.5 text-sm font-semibold text-slate-500 hover:text-slate-700 hover:bg-slate-50 rounded-xl transition-all">Batal</a>
                        <button type="submit"
                            class="px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-bold rounded-xl shadow-sm shadow-emerald-200 transition-all">
                            Simpan Data Barang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category_id');
            const codeInput = document.getElementById('code');

            categorySelect.addEventListener('change', function() {
                const categoryId = this.value;

                if (categoryId) {
                    codeInput.value = 'Menghitung nomor otomatis...';

                    fetch(`/products/get-next-code?category_id=${categoryId}`)
                        .then(response => response.json())
                        .then(data => {
                            codeInput.value = data.code;
                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan:', error);
                            codeInput.value = 'Gagal memuat kode';
                        });
                }
            });
        });
    </script>
</x-app-layout>
