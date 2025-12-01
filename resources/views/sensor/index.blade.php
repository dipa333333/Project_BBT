@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6">
    <!-- Header & Action -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Manajemen Sensor</h2>
            <p class="text-sm text-gray-500">Daftar perangkat IoT yang terhubung ke sistem.</p>
        </div>
        <a href="{{ route('sensor.create') }}"
           class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-medium transition shadow-lg shadow-blue-600/20">
            <span>+ Tambah Sensor</span>
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center shadow-sm">
        <span class="mr-2">✅</span>
        {{ session('success') }}
    </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-4 text-xs font-semibold tracking-wide text-gray-500 uppercase">Nama Sensor</th>
                        <th class="p-4 text-xs font-semibold tracking-wide text-gray-500 uppercase">Lokasi</th>
                        <th class="p-4 text-xs font-semibold tracking-wide text-gray-500 uppercase">Tipe</th>
                        <th class="p-4 text-xs font-semibold tracking-wide text-gray-500 uppercase">Status</th>
                        <th class="p-4 text-xs font-semibold tracking-wide text-gray-500 uppercase text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($data as $s)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="p-4 font-medium text-gray-800">
                            {{ $s->nama_sensor }}
                        </td>
                        <td class="p-4 text-gray-600">
                            {{ $s->lokasi }}
                        </td>
                        <td class="p-4">
                            <span class="bg-blue-50 text-blue-600 py-1 px-3 rounded-lg text-xs font-semibold border border-blue-100">
                                {{ $s->tipe }}
                            </span>
                        </td>
                        <td class="p-4">
                            @if($s->status == 'aktif')
                                <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    Non-Aktif
                                </span>
                            @endif
                        </td>
                        <td class="p-4 text-center flex justify-center gap-2">
                            <a href="{{ route('sensor.edit', $s->id) }}"
                               class="text-gray-500 hover:text-blue-600 transition p-2 hover:bg-blue-50 rounded-lg"
                               title="Edit">
                                ✏️
                            </a>

                            <form action="{{ route('sensor.destroy', $s->id) }}" method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus sensor ini? Data monitoring terkait mungkin juga akan hilang.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-gray-500 hover:text-red-600 transition p-2 hover:bg-red-50 rounded-lg"
                                        title="Hapus">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">
                            Belum ada data sensor. Silakan tambahkan sensor baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection