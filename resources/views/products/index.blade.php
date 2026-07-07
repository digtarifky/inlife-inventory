<x-app-layout>
    <div class="py-8 min-h-screen transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight transition-colors">Master
                        Data Barang</h1>
                </div>

                @if (Auth::user()->hasRole(['Admin', 'Staff']))
                    <div class="flex items-center gap-3">
                        <a href="{{ route('products.create') }}"
                            class="inline-flex items-center justify-center px-4 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold rounded-xl transition-all shadow-sm shadow-emerald-200 dark:shadow-emerald-900/20 gap-2">
                            + Tambah Barang
                        </a>
                    </div>
                @endif
            </div>

            @if (session('success'))
                <div
                    class="mb-6 flex items-center gap-3 p-4 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 rounded-2xl border border-emerald-100 dark:border-emerald-500/20 animate-fade-in transition-colors">
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            <div id="table-container">
                <div
                    class="bg-white dark:bg-slate-800 rounded-[28px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 dark:border-slate-700 overflow-hidden transition-colors">
                    <div class="overflow-x-auto relative">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-slate-50/80 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700 transition-colors">
                                    <th
                                        class="py-4 px-6 text-[11px] font-bold text-slate-400 dark:text-slate-300 uppercase w-16">
                                        No</th>
                                    <th
                                        class="py-4 px-6 text-[11px] font-bold text-slate-400 dark:text-slate-300 uppercase w-24">
                                        Gambar</th>
                                    <th
                                        class="py-4 px-6 text-[11px] font-bold text-slate-400 dark:text-slate-300 uppercase">
                                        Identitas Barang</th>
                                    <th
                                        class="py-4 px-6 text-[11px] font-bold text-slate-400 dark:text-slate-300 uppercase">
                                        Kategori & Kondisi</th>
                                    <th
                                        class="py-4 px-6 text-[11px] font-bold text-slate-400 dark:text-slate-300 uppercase">
                                        Status Stok</th>
                                    <th
                                        class="py-4 px-6 text-[11px] font-bold text-slate-400 dark:text-slate-300 uppercase">
                                        Lokasi Penyimpanan</th>
                                    <th
                                        class="py-4 px-6 text-[11px] font-bold text-slate-400 dark:text-slate-300 uppercase text-right">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 dark:divide-slate-700/50">
                                @forelse ($products as $index => $item)
                                    <tr
                                        class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-colors duration-150">

                                        <td class="py-4 px-6 text-sm font-medium text-slate-600 dark:text-slate-400">
                                            {{ $index + 1 }}
                                        </td>

                                        <td class="py-4 px-6">
                                            @if ($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}"
                                                    alt="{{ $item->name }}"
                                                    class="w-12 h-12 rounded-xl object-cover border border-slate-200 dark:border-slate-700 shadow-sm">
                                            @else
                                                <div
                                                    class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 dark:text-slate-500 text-xs font-bold">
                                                    NO IMG
                                                </div>
                                            @endif
                                        </td>

                                        <td class="py-4 px-6">
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-sm font-bold text-slate-800 dark:text-white transition-colors">{{ $item->name }}</span>
                                                <span
                                                    class="text-xs font-mono text-slate-400 mt-0.5">{{ $item->code }}</span>
                                            </div>
                                        </td>

                                        <td class="py-4 px-6">
                                            <div class="flex flex-col items-start gap-1">
                                                <span
                                                    class="text-xs font-semibold text-slate-700 dark:text-slate-300">{{ $item->category->name ?? 'Tanpa Kategori' }}</span>
                                                <span
                                                    class="text-[10px] font-bold px-2 py-0.5 rounded-full w-max {{ $item->condition == 'Bagus' ? 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400' : 'bg-rose-50 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400' }}">
                                                    • {{ $item->condition }}
                                                </span>
                                            </div>
                                        </td>

                                        <td class="py-4 px-6">
                                            <div class="flex flex-col items-start gap-1.5">
                                                <span
                                                    class="text-xs font-bold {{ $item->stock > 0 ? 'text-emerald-500 dark:text-emerald-400' : 'text-rose-500 dark:text-rose-400' }}">
                                                    {{ $item->stock > 0 ? '+ ' . $item->stock . ' Unit' : '0 Unit' }}
                                                </span>

                                                @if ($item->stock > 0 && $item->stock <= 5)
                                                    <span
                                                        class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400 border border-amber-100 dark:border-amber-500/20 animate-pulse">
                                                            Stok Menipis
                                                    </span>
                                                @elseif ($item->stock == 0)
                                                    <span
                                                        class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-rose-50 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400 border border-rose-100 dark:border-rose-500/20">
                                                            Stok Habis
                                                    </span>
                                                @endif
                                            </div>
                                        </td>

                                        <td class="py-4 px-6">
                                            <span
                                                class="text-xs font-medium text-slate-600 dark:text-slate-400">{{ $item->storage_location ?? '-' }}</span>
                                        </td>

                                        <td class="py-4 px-6 text-right">
                                            @if (Auth::user()->hasRole(['Admin', 'Staff']))
                                                <div class="flex items-center justify-end gap-2">

                                                    <a href="{{ route('products.show', $item->id) }}"
                                                        class="p-2 text-slate-400 hover:text-blue-500 dark:hover:text-blue-400 bg-slate-50 hover:bg-blue-50 dark:bg-slate-700/50 dark:hover:bg-blue-500/10 rounded-xl transition-all"
                                                        title="Lihat Detail">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                            class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                    </a>

                                                    <a href="{{ route('products.edit', $item->id) }}"
                                                        class="p-2 text-slate-400 hover:text-amber-500 dark:hover:text-amber-400 bg-slate-50 hover:bg-amber-50 dark:bg-slate-700/50 dark:hover:bg-amber-500/10 rounded-xl transition-all"
                                                        title="Edit Data">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                            class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                        </svg>
                                                    </a>

                                                    <form action="{{ route('products.destroy', $item->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Konfirmasi penghapusan data barang {{ $item->name }}?');"
                                                        class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="p-2 text-slate-400 hover:text-rose-500 dark:hover:text-rose-400 bg-slate-50 hover:bg-rose-50 dark:bg-slate-700/50 dark:hover:bg-rose-500/10 rounded-xl transition-all"
                                                            title="Hapus Data">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                            </svg>
                                                        </button>
                                                    </form>

                                                </div>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7"
                                            class="py-12 text-center text-slate-500 dark:text-slate-400 text-sm font-medium">
                                            Tidak ada data barang ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($products->hasPages())
                        <div
                            class="px-6 py-4 border-t border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50 transition-colors">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const tableContainer = document.getElementById('table-container');
            const loadingIndicator = document.getElementById('search-loading');
            let debounceTimer;

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(debounceTimer);
                    loadingIndicator.classList.remove('hidden');

                    debounceTimer = setTimeout(() => {
                        const query = searchInput.value;
                        const url = new URL(window.location.href);
                        url.searchParams.set('search', query);
                        url.searchParams.delete('page');
                        fetch(url, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => response.text())
                            .then(html => {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, 'text/html');
                                const newTableContent = doc.getElementById('table-container')
                                    .innerHTML;
                                tableContainer.innerHTML = newTableContent;
                                loadingIndicator.classList.add('hidden');
                                window.history.pushState({}, '', url);
                            })
                            .catch(error => {
                                console.error('Error fetching search results:', error);
                                loadingIndicator.classList.add('hidden');
                            });
                    }, 300);
                });
            }
        });
    </script>
</x-app-layout>
