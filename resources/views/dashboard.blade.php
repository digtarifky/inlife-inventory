<x-app-layout>
    <div class="py-8 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Selamat Datang, {{ Auth::user()->name }}</h1>
                    <p class="text-sm text-slate-400 mt-1">Sistem Pemantauan Inventaris Logistik Real-Time.</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center px-3.5 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                        Sistem Aktif
                    </span>
                    <span class="text-xs text-slate-400 font-medium bg-white px-3 py-1.5 rounded-xl border border-slate-100 shadow-sm">
                        Akses: {{ Auth::user()->role->name }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-white p-6 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100/80 transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.05)]">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-semibold text-slate-400 tracking-wide uppercase">Total Komoditas</span>
                        <div class="w-10 h-10 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5V18a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18V7.5m18 0V5.25A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25V7.5m18 0-8.967 5.23a1.217 1.217 0 0 1-1.217 0L3 7.5" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-extrabold text-slate-800 tracking-tight">{{ $totalBarang }}</span>
                        <span class="text-xs font-semibold text-slate-400">Unit Barang</span>
                    </div>
                </div>

                <div class="bg-emerald-600/5 p-6 rounded-[24px] border border-emerald-500/10 transition-all duration-300 hover:bg-emerald-600/[0.08]">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-semibold text-emerald-700/80 tracking-wide uppercase">Barang Tersedia</span>
                        <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-sm shadow-emerald-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-extrabold text-emerald-600 tracking-tight">{{ $barangTersedia }}</span>
                        <span class="text-xs font-semibold text-emerald-600/70">Siap Dipinjam</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-slate-100/80 transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.05)]">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-semibold text-slate-400 tracking-wide uppercase">Barang Dipinjam</span>
                        <div class="w-10 h-10 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0-4.5 4.5M21 7.5H7.5" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-extrabold text-slate-800 tracking-tight">{{ $barangDipinjam }}</span>
                        <span class="text-xs font-semibold text-slate-400">Sedang Digunakan</span>
                    </div>
                </div>

            </div>

            <div class="bg-white rounded-[28px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 p-8">
                <div class="border-b border-slate-100 pb-5 mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Ringkasan Aktivitas Sistem</h3>
                        <p class="text-sm text-slate-400 mt-0.5">Pantau status distribusi logistik inventaris.</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold rounded-xl transition-all duration-200 shadow-sm">
                            Kelola Inventaris
                        </a>
                    </div>
                </div>

                <div class="border-2 border-dashed border-slate-100 rounded-2xl p-12 text-center bg-slate-50/50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-slate-300 mx-auto mb-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v16.5A2.25 2.25 0 0 0 6 21.25h16.5M13.5 12v6m-3-3v3m6-6v6m3-9v9M6 18l4.5-4.5 4.5 4.5 4.5-4.5" />
                    </svg>
                    <p class="text-sm font-semibold text-slate-500">Belum ada aktivitas transaksi peminjaman terbaru.</p>
                    <p class="text-xs text-slate-400 mt-1">Data statistik logistik barang akan otomatis terperbarui di sini.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>