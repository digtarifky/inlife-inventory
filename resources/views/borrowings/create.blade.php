<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <style>
        .ts-control {
            border: none !important;
            padding: 0.875rem 1rem !important;
            border-radius: 1rem !important;
            background-color: #f8fafc !important;
            font-size: 0.875rem !important;
            transition: all 0.2s;
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 0.5rem !important;
        }
        .ts-control.focus {
            background-color: #ffffff !important;
            box-shadow: 0 0 0 2px #a7f3d0 !important;
        }
        
        .ts-control > input {
            order: -1 !important; 
            flex: 1 1 100% !important; 
            width: 100% !important;
            margin: 0 0 0.5rem 0 !important; 
        }

        .ts-control .item {
            background-color: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.5rem !important;
            padding: 0.35rem 0.75rem !important;
            color: #475569 !important;
            font-weight: 500 !important;
            box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05) !important;
        }

        .ts-dropdown {
            border-radius: 1rem !important;
            border: 1px solid #f1f5f9 !important; 
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
            padding: 0.5rem !important;
        }
        .ts-dropdown .option {
            border-radius: 0.5rem !important;
            padding: 0.5rem 0.75rem !important;
        }
        .ts-dropdown .option.active {
            background-color: #ecfdf5 !important; 
            color: #047857 !important; 
        }
    </style>
    <div class="py-8 bg-slate-50/50 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-6">
                <a href="{{ route('borrowings.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-700 mb-4 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
                    Kembali ke Log Peminjaman
                </a>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Catat Peminjaman Baru</h1>
                <p class="text-sm text-slate-400 mt-1">Pilih satu atau beberapa barang sekaligus. Stok akan dipotong otomatis.</p>
            </div>

            <div class="bg-white rounded-[28px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 p-8">
                <form action="{{ route('borrowings.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label for="borrow_date" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Mulai Pinjam</label>
                        <input type="date" name="borrow_date" id="borrow_date" value="{{ old('borrow_date', date('Y-m-d')) }}" class="block w-full px-4 py-3.5 bg-slate-50 border-transparent focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-200 rounded-2xl text-sm text-slate-700 transition-all" required>
                        @error('borrow_date') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-8">
                        <label for="product_ids" class="block text-sm font-semibold text-slate-700 mb-2">Pilih Barang (Bisa ketik nama/kode)</label>
                        
                        <select name="product_ids[]" id="product_ids" multiple placeholder="Ketik nama atau kode barang..." autocomplete="off" required>
                            <option value="">Ketik nama atau kode barang...</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name }} ({{ $product->code }}) — Sisa: {{ $product->stock }} Unit
                                </option>
                            @endforeach
                        </select>
                        
                        @error('product_ids') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                        @error('product_ids.*') <span class="text-xs text-red-500 mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-8 p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-400">Penanggung Jawab (Peminjam)</p>
                            <p class="text-sm font-bold text-slate-700">{{ Auth::user()->name }} <span class="text-xs font-semibold text-emerald-500 bg-emerald-50 px-1.5 py-0.5 rounded ml-1">{{ Auth::user()->role?->name ?? 'Staff' }}</span></p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                        <a href="{{ route('borrowings.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-500 hover:text-slate-700 hover:bg-slate-50 rounded-xl transition-all">Batal</a>
                        <button type="submit" class="px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-bold rounded-xl shadow-sm shadow-emerald-200 transition-all">
                            Proses Peminjaman Aset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {   
            new TomSelect("#product_ids", {
                plugins: ['remove_button'], 
                maxOptions: 50, 
                placeholder: 'Cari berdasarkan nama atau kode...',
                searchField: ['text'],
                render: {
                    no_results: function(data, escape) {
                        return '<div class="no-results p-2 text-sm text-slate-400">Barang "' + escape(data.input) + '" tidak ditemukan atau stok kosong.</div>';
                    }
                }
            });
        });
    </script>
</x-app-layout>