<x-app-layout>
    <div class="py-8 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="text-sm text-slate-500 mt-1">Berikut adalah ringkasan inventaris pada tahun {{ $currentYear }}.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-white rounded-[24px] p-6 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 flex items-center gap-5 transition-transform hover:-translate-y-1 duration-300">
                    <div class="w-14 h-14 bg-indigo-50 text-indigo-500 rounded-2xl flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-400 mb-1">Total Barang</p>
                        <h3 class="text-3xl font-black text-slate-800">{{ $totalTypes }} <span class="text-base font-bold text-slate-300">Jenis</span></h3>
                        <p class="text-[11px] font-bold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-lg inline-block mt-2">
                            Total Fisik: {{ number_format($totalStock, 0, ',', '.') }} Unit
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-[24px] p-6 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 flex items-center gap-5 transition-transform hover:-translate-y-1 duration-300">
                    <div class="w-14 h-14 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-400 mb-1">Barang Dipinjam</p>
                        <h3 class="text-3xl font-black text-slate-800">{{ number_format($borrowedItems, 0, ',', '.') }} <span class="text-base font-bold text-slate-300">Item</span></h3>
                        <p class="text-[11px] font-bold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-lg inline-block mt-2">
                            Sedang Sirkulasi
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-[24px] p-6 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 flex items-center gap-5 transition-transform hover:-translate-y-1 duration-300">
                    <div class="w-14 h-14 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" /></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-400 mb-1">Barang Tersedia</p>
                        <h3 class="text-3xl font-black text-slate-800">{{ $availableTypes }} <span class="text-base font-bold text-slate-300">Jenis</span></h3>
                        <p class="text-[11px] font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg inline-block mt-2">
                            Total Fisik: {{ number_format($availableStock, 0, ',', '.') }} Unit
                        </p>
                    </div>
                </div>

            </div>

            <div class="bg-white rounded-[28px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 p-8">
                <div class="mb-6">
                    <h2 class="text-lg font-bold text-slate-800">Grafik Peminjaman per Bulan</h2>
                </div>
                
                <div id="borrowingChart" class="w-full min-h-[350px]"></div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        setTimeout(function() {
            var options = {
                series: [{
                    name: 'Jumlah Transaksi',
                    data: {!! json_encode($chartData) !!}
                }],
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: { show: false },
                    fontFamily: 'inherit',
                    zoom: { enabled: false }
                },
                colors: ['#10b981'], 
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.05,
                        stops: [0, 100]
                    }
                },
                dataLabels: {
                    enabled: false 
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                xaxis: {
                    categories: {!! json_encode($months) !!},
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: { style: { colors: '#94a3b8', fontWeight: 500 } }
                },
                yaxis: {
                    labels: {
                        style: { colors: '#94a3b8', fontWeight: 500 },
                        formatter: function (val) { return val.toFixed(0); }
                    }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4,
                    yaxis: { lines: { show: true } },
                    xaxis: { lines: { show: false } }
                }
            };

            var chart = new ApexCharts(document.querySelector("#borrowingChart"), options);
            chart.render();
        }, 150); 
    </script>
</x-app-layout>