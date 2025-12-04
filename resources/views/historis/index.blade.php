@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">

    <!-- HEADER SECTION -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-blue-700 flex items-center gap-2">
                Data Historis Pemakaian
            </h2>
            <p class="text-sm text-gray-500 mt-1">Arsip lengkap riwayat konsumsi air dan tekanan pipa.</p>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-2">
            <button class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 hover:text-green-600 transition shadow-sm">
                <i data-lucide="file-spreadsheet" class="w-4 h-4"></i> Export Excel
            </button>
            <button class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-md shadow-blue-600/20">
                <i data-lucide="printer" class="w-4 h-4"></i> Print Laporan
            </button>
        </div>
    </div>

    <!-- FILTER CARD -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-6">
        <form class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

            <!-- Tanggal Mulai -->
            <div class="md:col-span-4">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Dari Tanggal</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="calendar" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <input type="date" class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:bg-white transition text-gray-700">
                </div>
            </div>

            <!-- Tanggal Akhir -->
            <div class="md:col-span-4">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Sampai Tanggal</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="calendar" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <input type="date" class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:bg-white transition text-gray-700">
                </div>
            </div>

            <!-- Filter Button -->
            <div class="md:col-span-2">
                <button type="button" class="w-full py-2.5 bg-gray-800 hover:bg-gray-900 text-white rounded-lg font-medium transition flex items-center justify-center gap-2">
                    <i data-lucide="filter" class="w-4 h-4"></i> Terapkan
                </button>
            </div>

            <!-- Reset -->
            <div class="md:col-span-2">
                <button type="button" class="w-full py-2.5 text-gray-500 hover:text-red-600 font-medium transition text-sm">
                    Reset Filter
                </button>
            </div>

        </form>
    </div>

    <!-- DATA TABLE -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-5 text-xs font-semibold tracking-wide text-gray-500 uppercase">Tanggal & Waktu</th>
                        <th class="p-5 text-xs font-semibold tracking-wide text-gray-500 uppercase">Sensor ID</th>
                        <th class="p-5 text-xs font-semibold tracking-wide text-gray-500 uppercase">Volume Air</th>
                        <th class="p-5 text-xs font-semibold tracking-wide text-gray-500 uppercase">Tekanan</th>
                        <th class="p-5 text-xs font-semibold tracking-wide text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">

                    {{-- Loop Simulasi Data (Bisa diganti Foreach nanti) --}}
                    @for($i=1; $i<=8; $i++)
                    @php
                        // Simulasi Logika Data
                        $usage = rand(300, 950);
                        $pressure = rand(15, 35) / 10; // 1.5 - 3.5 Bar
                        $status = ($usage > 850) ? 'Tinggi' : 'Normal';
                    @endphp

                    <tr class="hover:bg-blue-50/50 transition duration-150">
                        <td class="p-5 text-sm text-gray-600">
                            <div class="font-medium text-gray-900">2025-11-{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</div>
                            <div class="text-xs text-gray-400">14:30:{{ rand(10,59) }} WIB</div>
                        </td>
                        <td class="p-5 text-sm text-gray-600 font-mono">
                            SNR-00{{ rand(1,3) }}
                        </td>
                        <td class="p-5">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-gray-800">{{ $usage }}</span>
                                <span class="text-xs text-gray-500">Liter</span>
                            </div>
                        </td>
                        <td class="p-5">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-600">
                                {{ $pressure }} Bar
                            </span>
                        </td>
                        <td class="p-5">
                            @if($status == 'Normal')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 border border-green-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Normal
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700 border border-orange-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Pemakaian Tinggi
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endfor

                </tbody>
            </table>
        </div>

        <!-- Pagination Dummy -->
        <div class="bg-gray-50 px-5 py-4 border-t border-gray-100 flex items-center justify-between">
            <span class="text-xs text-gray-500">Menampilkan 1-8 dari 124 data</span>
            <div class="flex gap-1">
                <button class="px-3 py-1 rounded border bg-white text-gray-600 text-xs hover:bg-gray-100" disabled>Previous</button>
                <button class="px-3 py-1 rounded border bg-blue-600 text-white text-xs">1</button>
                <button class="px-3 py-1 rounded border bg-white text-gray-600 text-xs hover:bg-gray-100">2</button>
                <button class="px-3 py-1 rounded border bg-white text-gray-600 text-xs hover:bg-gray-100">3</button>
                <button class="px-3 py-1 rounded border bg-white text-gray-600 text-xs hover:bg-gray-100">Next</button>
            </div>
        </div>

    </div>
</div>

<script>
    lucide.createIcons();
</script>

@endsection