<x-app-layout>
    <div class="py-8 min-h-screen transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight transition-colors">Sirkulasi Peminjaman Barang</h1>
                    <p class="text-sm text-slate-400 mt-1 transition-colors">Pantau barang yang sedang dipinjam dan riwayat pengembalian.</p>
                </div>
                @if(Auth::user()->hasRole(['Admin', 'Staff']))
                <div>
                    <a href="{{ route('borrowings.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold rounded-xl transition-all shadow-sm shadow-emerald-200 dark:shadow-emerald-900/20 gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                        Catat Peminjaman
                    </a>
                </div>
                @endif
            </div>

            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 p-4 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 rounded-2xl border border-emerald-100 dark:border-emerald-500/20 animate-fade-in transition-colors">
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="mb-10">
                <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2 transition-colors">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-pulse"></span>
                    Sedang Dipinjam
                </h2>
                
                <div class="bg-white dark:bg-slate-800 rounded-[28px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 dark:border-slate-700 overflow-hidden transition-colors duration-300">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/80 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700 transition-colors">
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 dark:text-slate-300 uppercase tracking-wider">Transaksi & Peminjam</th>
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 dark:text-slate-300 uppercase tracking-wider">Barang Logistik</th>
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 dark:text-slate-300 uppercase tracking-wider">Tanggal Pinjam</th>
                                    @if(Auth::user()->hasRole(['Admin', 'Staff']))
                                        <th class="py-4 px-6 text-[11px] font-bold text-slate-400 dark:text-slate-300 uppercase tracking-wider text-right">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 dark:divide-slate-700/50">
                                @forelse ($activeItems as $item)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-colors duration-150">
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-bold text-slate-800 dark:text-white transition-colors">{{ $item->borrowing->user->name }}</span>
                                                <span class="text-xs font-semibold text-slate-400 mt-0.5">Nota: TRX-{{ str_pad($item->borrowing_id, 4, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-bold text-slate-800 dark:text-white transition-colors">{{ $item->product->name }}</span>
                                                <span class="text-xs font-mono text-slate-400 mt-0.5">{{ $item->product->code }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300 transition-colors">{{ \Carbon\Carbon::parse($item->borrowing->borrow_date)->format('d M Y') }}</span>
                                        </td>
                                        @if(Auth::user()->hasRole(['Admin', 'Staff']))
                                        <td class="py-4 px-6 text-right">
                                            <form action="{{ route('borrowings.return_item', $item->id) }}" method="POST" onsubmit="return confirm('Konfirmasi bahwa barang {{ $item->product->name }} ini telah dikembalikan?');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="inline-flex items-center justify-center px-3 py-1.5 bg-blue-50 dark:bg-blue-500/10 hover:bg-blue-600 text-blue-600 dark:text-blue-400 hover:text-white text-xs font-bold rounded-xl transition-all duration-150 border border-blue-100 dark:border-transparent gap-1">
                                                    Proses Kembali
                                                </button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-12 text-center text-slate-500 dark:text-slate-400 text-sm font-medium transition-colors">
                                            Tidak ada barang yang sedang dipinjam saat ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2 transition-colors">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    Riwayat Selesai
                </h2>
                
                <div class="bg-white dark:bg-slate-800 rounded-[28px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 dark:border-slate-700 overflow-hidden transition-colors duration-300">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/80 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700 transition-colors">
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 dark:text-slate-300 uppercase tracking-wider">Transaksi & Peminjam</th>
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 dark:text-slate-300 uppercase tracking-wider">Barang Logistik</th>
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 dark:text-slate-300 uppercase tracking-wider">Waktu Sirkulasi</th>
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 dark:text-slate-300 uppercase tracking-wider text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 dark:divide-slate-700/50">
                                @forelse ($completedItems as $item)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-colors duration-150">
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-bold text-slate-800 dark:text-white transition-colors">{{ $item->borrowing->user->name }}</span>
                                                <span class="text-xs font-semibold text-slate-400 mt-0.5">Nota: TRX-{{ str_pad($item->borrowing_id, 4, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-bold text-slate-800 dark:text-white transition-colors">{{ $item->product->name }}</span>
                                                <span class="text-xs font-mono text-slate-400 mt-0.5">{{ $item->product->code }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col gap-0.5">
                                                <span class="text-xs font-medium text-slate-600 dark:text-slate-300 transition-colors">Pinjam: <strong>{{ \Carbon\Carbon::parse($item->borrowing->borrow_date)->format('d M Y') }}</strong></span>
                                                <span class="text-xs font-medium text-slate-400">Kembali: <strong class="text-emerald-600 dark:text-emerald-400">{{ \Carbon\Carbon::parse($item->return_date)->format('d M Y') }}</strong></span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 border border-emerald-100 dark:border-transparent transition-colors">
                                                Selesai
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-12 text-center text-slate-500 dark:text-slate-400 text-sm font-medium transition-colors">
                                            Belum ada riwayat pengembalian barang.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($completedItems->hasPages())
                        <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50 transition-colors">
                            {{ $completedItems->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>