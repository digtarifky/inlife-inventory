<x-app-layout>
    <div class="py-8 min-h-screen transition-colors duration-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-6">
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Kembali ke Daftar Barang
                </a>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white mt-2">Edit Data Barang</h1>
            </div>

            <div
                class="bg-white dark:bg-slate-800 rounded-[28px] shadow-sm border border-slate-100 dark:border-slate-700 p-8">
                <form action="{{ route('products.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @if ($errors->any())
                        <div
                            class="mb-6 p-4 bg-rose-50 dark:bg-rose-500/10 border border-rose-200 dark:border-rose-500/20 rounded-2xl">
                            <div class="flex items-center gap-2 text-rose-700 dark:text-rose-400 font-bold mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                Oops! Ada kesalahan input:
                            </div>
                            <ul class="list-disc list-inside text-sm text-rose-600 dark:text-rose-400">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama
                                Barang</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-200 focus:ring-emerald-500 focus:border-emerald-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Kode
                                Barang</label>
                            <input type="text" name="code" value="{{ old('code', $product->code) }}"
                                class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-200 focus:ring-emerald-500 focus:border-emerald-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">ID
                                Kategori</label>
                            <input type="number" name="category_id"
                                value="{{ old('category_id', $product->category_id) }}"
                                class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-200 focus:ring-emerald-500 focus:border-emerald-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Stok
                                (Unit)</label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                                class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-200 focus:ring-emerald-500 focus:border-emerald-500"
                                required min="0">
                        </div>

                        <div>
                            <label
                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Kondisi</label>
                            <select name="condition"
                                class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-200 focus:ring-emerald-500 focus:border-emerald-500"
                                required>
                                <option value="Bagus" {{ $product->condition == 'Bagus' ? 'selected' : '' }}>Bagus
                                </option>
                                <option value="Rusak Ringan"
                                    {{ $product->condition == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="Rusak Berat"
                                    {{ $product->condition == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Lokasi
                                Penyimpanan</label>
                            <input type="text" name="storage_location" value="{{ old('storage_location', $product->storage_location) }}"
                                class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-200 focus:ring-emerald-500 focus:border-emerald-500"
                                placeholder="Contoh: Gedung B,Lantai 1">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Ganti Gambar
                            (Opsional)</label>
                        @if ($product->image)
                            <div class="mb-3">
                                <p class="text-xs text-slate-400 mb-2">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    class="w-24 h-24 rounded-xl object-cover border border-slate-200 dark:border-slate-700 shadow-sm">
                            </div>
                        @endif
                        <input type="file" name="image" accept="image/*"
                            class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 dark:file:bg-emerald-500/10 dark:file:text-emerald-400 hover:file:bg-emerald-100 cursor-pointer border border-slate-200 dark:border-slate-700 rounded-xl transition-colors">
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-700 flex justify-end">
                        <button type="submit"
                            class="px-6 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-xl transition-all shadow-sm shadow-emerald-200 dark:shadow-emerald-900/20">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
