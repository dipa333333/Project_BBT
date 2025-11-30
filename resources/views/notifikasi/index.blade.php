@extends('layouts.app')

@section('content')

<!-- HEADER -->
<div class="mb-6">
    <h2 class="text-3xl font-bold text-blue-700">Notifikasi Sistem</h2>
    <p class="text-gray-600">Daftar peringatan, info, dan status dari sistem Smart Meter Anda.</p>
</div>

<!-- NOTIFIKASI TABLE -->
<div class="bg-white rounded-xl shadow overflow-hidden">

    <table class="w-full border-collapse">

        <!-- TABLE HEADER -->
        <thead class="bg-blue-50 border-b">
            <tr>
                <th class="p-3 text-left font-semibold text-gray-700">Jenis</th>
                <th class="p-3 text-left font-semibold text-gray-700">Pesan</th>
                <th class="p-3 text-left font-semibold text-gray-700">Status</th>
                <th class="p-3 text-left font-semibold text-gray-700">Aksi</th>
            </tr>
        </thead>

        <!-- TABLE BODY -->
        <tbody>
            @foreach($data as $n)

            <tr class="border-b hover:bg-blue-50 transition">

                <!-- JENIS -->
                <td class="p-3 font-medium">
                    @if($n->tipe == 'warning')
                        ⚠️ <span class="text-yellow-600 font-semibold">Warning</span>
                    @elseif($n->tipe == 'error')
                        ❌ <span class="text-red-600 font-semibold">Error</span>
                    @else
                        ℹ️ <span class="text-blue-600 font-semibold">Info</span>
                    @endif
                </td>

                <!-- PESAN -->
                <td class="p-3 text-gray-700">
                    {{ $n->pesan }}
                </td>

                <!-- STATUS -->
                <td class="p-3">
                    @if($n->status == 'baru')
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                            Baru
                        </span>
                    @elseif($n->status == 'dibaca')
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                            Dibaca
                        </span>
                    @else
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm font-semibold">
                            Arsip
                        </span>
                    @endif
                </td>

                <!-- AKSI -->
                <td class="p-3">
                    <form method="POST" action="/notifikasi/{{ $n->id }}">
                        @csrf @method('DELETE')

                        <button
                            class="px-3 py-1 text-red-600 hover:text-red-800 font-semibold">
                            Hapus
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection
