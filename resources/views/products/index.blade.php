<x-app-layout>
    <div class="py-8 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Master Data Barang</h1>
                    <p class="text-sm text-slate-400 mt-1">Kelola daftar inventaris logistik dan pantau ketersediaan
                        stok.</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <input type="text" id="search-input" name="search" value="{{ $search ?? '' }}"
                            placeholder="Ketik nama atau kode..." autocomplete="off"
                            class="pl-10 pr-4 py-2.5 bg-white border border-slate-200 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 rounded-xl text-sm w-64 transition-all">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <div id="search-loading" class="absolute inset-y-0 right-0 pr-3 items-center hidden">
                            <svg class="animate-spin h-4 w-4 text-emerald-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                    </div>

                    <a href="{{ route('products.create') }}"
                        class="inline-flex items-center justify-center px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold rounded-xl transition-all shadow-sm shadow-emerald-200 gap-2 whitespace-nowrap">
                        Tambah Barang
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div
                    class="mb-6 flex items-center gap-3 p-4 bg-emerald-50 text-emerald-700 rounded-2xl border border-emerald-100 animate-fade-in">
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            <div id="table-container">
                <div
                    class="bg-white rounded-[28px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 overflow-hidden">
                    <div class="overflow-x-auto relative">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/80 border-b border-slate-100">
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase w-16">No</th>
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase">Identitas
                                        Barang</th>
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase">Kategori &
                                        Kondisi</th>
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase">Status Stok
                                    </th>
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase">Lokasi
                                        Penyimpanan</th>
                                    <th class="py-4 px-6 text-[11px] font-bold text-slate-400 uppercase text-right">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($products as $index => $product)
                                    <tr class="hover:bg-slate-50/50 transition-colors group">
                                        <td class="py-4 px-6 text-sm text-slate-400 font-medium">
                                            {{ $products->firstItem() + $index }}</td>
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-sm font-bold text-slate-800">{{ $product->name }}</span>
                                                <span
                                                    class="text-xs font-medium text-slate-400 mt-0.5">{{ $product->code }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 flex flex-col items-start gap-1">
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-slate-100 text-slate-600">
                                                {{ $product->category->name }}
                                            </span>
                                            <span
                                                class="text-[11px] font-semibold {{ $product->condition == 'Bagus' ? 'text-emerald-500' : 'text-amber-500' }}">
                                                • {{ $product->condition }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            @if ($product->stock == 0)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-red-50 text-red-600">Stok
                                                    Habis</span>
                                            @elseif($product->stock < 5)
                                                <span
                                                    class="inline-flex items-center gap-1.5 text-sm font-bold text-amber-600">
                                                    <span
                                                        class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>{{ $product->stock }}
                                                    Unit (Menipis)
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1.5 text-sm font-bold text-emerald-600">
                                                    <span
                                                        class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>{{ $product->stock }}
                                                    Unit
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <span
                                                class="text-sm text-slate-600">{{ $product->storage_location }}</span>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <div
                                                class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                <a href="{{ route('products.show', $product->id) }}"
                                                    class="p-2 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all"
                                                    title="Detail Barang">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all"
                                                    title="Edit Barang">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('products.destroy', $product->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Hapus data ini?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all"
                                                        title="Hapus Barang">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-16 text-center text-slate-500">Tidak ada data
                                            ditemukan untuk pencarian tersebut.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($products->hasPages())
                        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
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

            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);

                // Tampilkan ikon loading
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
        });
    </script>
</x-app-layout>
