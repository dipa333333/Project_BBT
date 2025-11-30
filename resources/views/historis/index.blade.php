@extends('layouts.app')

@section('content')

<!-- HEADER -->
<div class="mb-6">
    <h2 class="text-3xl font-bold text-blue-700">Data Historis Pemakaian Air</h2>
    <p class="text-gray-600">Riwayat penggunaan air berdasarkan tanggal yang dipilih.</p>
</div>

<!-- FILTER CARD -->
<div class="bg-white p-5 rounded-xl shadow-md mb-6">
    <form class="flex flex-col md:flex-row md:items-center gap-3">

        <div class="flex flex-col w-full md:w-1/3">
            <label class="text-gray-700 font-semibold mb-1">Tanggal Mulai</label>
            <input type="date" class="border p-2 rounded focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex flex-col w-full md:w-1/3">
            <label class="text-gray-700 font-semibold mb-1">Tanggal Akhir</label>
            <input type="date" class="border p-2 rounded focus:ring-2 focus:ring-blue-400">
        </div>

        <button
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow w-full md:w-auto mt-2 md:mt-6">
            Filter
        </button>

    </form>
</div>

<!-- TABLE CARD -->
<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full border-collapse">

        <!-- TABLE HEADER -->
        <thead class="bg-blue-50 border-b">
            <tr>
                <th class="p-3 text-left font-semibold text-gray-700">Tanggal</th>
                <th class="p-3 text-left font-semibold text-gray-700">Pemakaian (Liter)</th>
                <th class="p-3 text-left font-semibold text-gray-700">Tekanan (Bar)</th>
                <th class="p-3 text-left font-semibold text-gray-700">Status</th>
            </tr>
        </thead>

        <!-- TABLE CONTENT -->
        <tbody>
            @for($i=1; $i<=10; $i++)
            <tr class="border-b hover:bg-blue-50 transition">
                <td class="p-3">2025-11-{{ $i }}</td>
                <td class="p-3">{{ rand(300, 900) }} L</td>
                <td class="p-3">{{ rand(1,3) }}</td>
                <td class="p-3">
                    <span class="text-green-600 font-semibold">Normal</span>
                </td>
            </tr>
            @endfor
        </tbody>
    </table>
</div>

@endsection
