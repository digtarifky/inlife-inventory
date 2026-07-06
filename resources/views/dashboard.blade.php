<x-app-layout>
    <div class="py-8 min-h-screen transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight transition-colors">
                        Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 transition-colors">Berikut adalah ringkasan
                        inventaris pada tahun {{ $currentYear ?? date('Y') }}.</p>
                </div>

                @if (Auth::user()->hasRole(['Admin', 'Manager']))
                    <div class="flex items-center gap-3">
                        <a href="{{ route('export.excel') }}"
                            class="inline-flex items-center justify-center px-4 py-2 bg-emerald-50 dark:bg-emerald-500/10 hover:bg-emerald-100 dark:hover:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-sm font-semibold rounded-xl border border-emerald-200 dark:border-transparent transition-all duration-200 gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            Excel
                        </a>
                        <a href="{{ route('export.pdf') }}"
                            class="inline-flex items-center justify-center px-4 py-2 bg-rose-50 dark:bg-rose-500/10 hover:bg-rose-100 dark:hover:bg-rose-500/20 text-rose-600 dark:text-rose-400 text-sm font-semibold rounded-xl border border-rose-200 dark:border-transparent transition-all duration-200 gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            PDF
                        </a>
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <div
                    class="bg-white dark:bg-slate-800 rounded-[24px] p-6 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 dark:border-slate-700 flex items-center gap-5 transition-all duration-300 hover:-translate-y-1">
                    <div
                        class="w-14 h-14 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-500 rounded-2xl flex items-center justify-center shrink-0 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-400 dark:text-slate-400 mb-1">Total Barang</p>
                        <h3 class="text-3xl font-black text-slate-800 dark:text-white transition-colors">
                            {{ $totalTypes }} <span
                                class="text-base font-bold text-slate-300 dark:text-slate-500">Jenis</span></h3>
                        <p
                            class="text-[11px] font-bold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10 px-2.5 py-1 rounded-lg inline-block mt-2 transition-colors">
                            Total Fisik: {{ number_format($totalStock, 0, ',', '.') }} Unit
                        </p>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-slate-800 rounded-[24px] p-6 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 dark:border-slate-700 flex items-center gap-5 transition-all duration-300 hover:-translate-y-1">
                    <div
                        class="w-14 h-14 bg-amber-50 dark:bg-amber-500/10 text-amber-500 rounded-2xl flex items-center justify-center shrink-0 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-400 mb-1">Barang Dipinjam</p>
                        <h3 class="text-3xl font-black text-slate-800 dark:text-white transition-colors">
                            {{ number_format($borrowedItems, 0, ',', '.') }} <span
                                class="text-base font-bold text-slate-300 dark:text-slate-500">Item</span></h3>
                        <p
                            class="text-[11px] font-bold text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-500/10 px-2.5 py-1 rounded-lg inline-block mt-2 transition-colors">
                            Sedang Sirkulasi
                        </p>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-slate-800 rounded-[24px] p-6 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 dark:border-slate-700 flex items-center gap-5 transition-all duration-300 hover:-translate-y-1">
                    <div
                        class="w-14 h-14 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 rounded-2xl flex items-center justify-center shrink-0 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-400 mb-1">Barang Tersedia</p>
                        <h3 class="text-3xl font-black text-slate-800 dark:text-white transition-colors">
                            {{ $availableTypes }} <span
                                class="text-base font-bold text-slate-300 dark:text-slate-500">Jenis</span></h3>
                        <p
                            class="text-[11px] font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-500/10 px-2.5 py-1 rounded-lg inline-block mt-2 transition-colors">
                            Total Fisik: {{ number_format($availableStock, 0, ',', '.') }} Unit
                        </p>
                    </div>
                </div>

            </div>

            <div
                class="bg-white dark:bg-slate-800 rounded-[28px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.02)] border border-slate-100 dark:border-slate-700 p-8 transition-colors duration-300">
                <div class="mb-6">
                    <h2 class="text-lg font-bold text-slate-800 dark:text-white transition-colors">Grafik Peminjaman per
                        Bulan</h2>
                </div>

                <div id="borrowingChart" class="w-full min-h-[350px]"></div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        setTimeout(function() {
            // Fungsi untuk mengecek tema saat ini agar grid grafik ikut menyesuaikan
            const isDark = document.documentElement.classList.contains('dark');
            const gridColor = isDark ? '#334155' : '#f1f5f9'; // slate-700 vs slate-100
            const labelColor = isDark ? '#94a3b8' : '#94a3b8'; // Label tetap slate-400

            var options = {
                series: [{
                    name: 'Jumlah Transaksi',
                    data: {!! json_encode($chartData) !!}
                }],
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    },
                    fontFamily: 'inherit',
                    zoom: {
                        enabled: false
                    },
                    background: 'transparent' // Penting agar grafik menyatu dengan card
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
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontWeight: 500
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontWeight: 500
                        },
                        formatter: function(val) {
                            return val.toFixed(0);
                        }
                    }
                },
                grid: {
                    borderColor: gridColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    },
                    xaxis: {
                        lines: {
                            show: false
                        }
                    }
                },
                theme: {
                    mode: isDark ? 'dark' : 'light' // Memberitahu apexchart tema saat ini
                }
            };

            var chart = new ApexCharts(document.querySelector("#borrowingChart"), options);
            chart.render();

            // Mendengarkan perubahan tema pada dokumen untuk me-render ulang grafik
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === "class") {
                        const newIsDark = document.documentElement.classList.contains('dark');
                        chart.updateOptions({
                            theme: {
                                mode: newIsDark ? 'dark' : 'light'
                            },
                            grid: {
                                borderColor: newIsDark ? '#334155' : '#f1f5f9'
                            }
                        });
                    }
                });
            });
            observer.observe(document.documentElement, {
                attributes: true
            });

        }, 150);
    </script>
</x-app-layout>
