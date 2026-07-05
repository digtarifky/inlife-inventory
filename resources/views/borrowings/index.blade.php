<x-app-layout>
    <div class="py-8 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Sirkulasi Peminjaman Barang</h1>
                    <p class="text-sm text-slate-400 mt-1">Pantau barang yang sedang dipinjam dan riwayat pengembalian.</p>
                </div>
                @if(Auth::user()->hasRole(['Admin', 'Staff']))
                <div>
                    <a href="{{ route('borrowings.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold rounded-xl transition-all shadow-sm shadow-emerald-200 gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                        Catat Peminjaman
                    </a>
                </div>
                @endif
            </div>

            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 p-4 bg-emerald-50 text-emerald-700 rounded-2xl border border-emerald-100 animate-fade-in">
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="mb-10">
                <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-pulse"></span>
                    Sedang Dipinjam
                </h2>
                
                <div class="bg-white rounded-[28px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/80 border-b border-slate-100">
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Transaksi & Peminjam</th>
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Barang Logistik</th>
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tanggal Pinjam</th>
                                    @if(Auth::user()->hasRole(['Admin', 'Staff']))
                                        <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($activeItems as $item)
                                    <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-bold text-slate-800">{{ $item->borrowing->user->name }}</span>
                                                <span class="text-xs font-semibold text-slate-400 mt-0.5">Nota: TRX-{{ str_pad($item->borrowing_id, 4, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-bold text-slate-800">{{ $item->product->name }}</span>
                                                <span class="text-xs font-mono text-slate-400 mt-0.5">{{ $item->product->code }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="text-sm font-medium text-slate-700">{{ \Carbon\Carbon::parse($item->borrowing->borrow_date)->format('d M Y') }}</span>
                                        </td>
                                        @if(Auth::user()->hasRole(['Admin', 'Staff']))
                                        <td class="py-4 px-6 text-right">
                                            <form action="{{ route('borrowings.return_item', $item->id) }}" method="POST" onsubmit="return confirm('Konfirmasi bahwa barang {{ $item->product->name }} ini telah dikembalikan?');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="inline-flex items-center justify-center px-3 py-1.5 bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white text-xs font-bold rounded-xl transition-all duration-150 border border-blue-100 hover:border-transparent gap-1">
                                                    Proses Kembali
                                                </button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-12 text-center text-slate-500 text-sm font-medium">
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
                <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    Riwayat Selesai
                </h2>
                
                <div class="bg-white rounded-[28px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/80 border-b border-slate-100">
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Transaksi & Peminjam</th>
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Barang Logistik</th>
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Waktu Sirkulasi</th>
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($completedItems as $item)
                                    <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-bold text-slate-800">{{ $item->borrowing->user->name }}</span>
                                                <span class="text-xs font-semibold text-slate-400 mt-0.5">Nota: TRX-{{ str_pad($item->borrowing_id, 4, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-bold text-slate-800">{{ $item->product->name }}</span>
                                                <span class="text-xs font-mono text-slate-400 mt-0.5">{{ $item->product->code }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col gap-0.5">
                                                <span class="text-xs font-medium text-slate-600">Pinjam: <strong>{{ \Carbon\Carbon::parse($item->borrowing->borrow_date)->format('d M Y') }}</strong></span>
                                                <span class="text-xs font-medium text-slate-400">Kembali: <strong class="text-emerald-600">{{ \Carbon\Carbon::parse($item->return_date)->format('d M Y') }}</strong></span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                                Selesai
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-12 text-center text-slate-500 text-sm font-medium">
                                            Belum ada riwayat pengembalian barang.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($completedItems->hasPages())
                        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                            {{ $completedItems->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>