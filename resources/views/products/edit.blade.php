<x-app-layout>
    <div class="py-8 min-h-screen transition-colors duration-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-6">
                <a href="{{ route('products.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 mb-4 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
                    Kembali ke Daftar Barang
                </a>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight transition-colors">Detail Inventaris</h1>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-[28px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 dark:border-slate-700 p-8 transition-colors duration-300">
                <div class="flex items-start justify-between border-b border-slate-100 dark:border-slate-700 pb-6 mb-6 transition-colors">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 dark:text-white transition-colors">{{ $product->name }}</h2>
                        <p class="text-sm text-slate-400 dark:text-slate-400 mt-1 font-mono bg-slate-100 dark:bg-slate-700 inline-block px-2 py-0.5 rounded transition-colors">{{ $product->code }}</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 transition-colors">
                            {{ $product->category->name }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Status Ketersediaan</p>
                            <p class="text-lg font-bold {{ $product->stock > 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }} transition-colors">{{ $product->stock }} Unit Tersedia</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Lokasi Penyimpanan</p>
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-200 transition-colors">{{ $product->storage_location ?? 'Belum ditentukan' }}</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Kondisi Aset</p>
                            <p class="text-sm font-bold {{ $product->condition == 'Bagus' ? 'text-emerald-500' : 'text-amber-500' }}">{{ $product->condition }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Tanggal Registrasi</p>
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-200 transition-colors">{{ $product->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-700 transition-colors">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Spesifikasi / Deskripsi</p>
                    <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed transition-colors">{{ $product->description ?: 'Tidak ada deskripsi tambahan untuk aset ini.' }}</p>
                </div>
                
                <div class="mt-8 pt-6 flex gap-3">
                    <a href="{{ route('products.edit', $product->id) }}" class="px-5 py-2.5 bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-500/20 text-sm font-semibold rounded-xl transition-all">Edit Data Ini</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>