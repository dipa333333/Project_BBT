@extends('layouts.app')

@section('content')

<div class="mb-6">
    <h2 class="text-3xl font-bold text-blue-700">Data Sensor</h2>
    <p class="text-gray-600">Kelola sensor pemantauan air tanah di sistem Smart Metering.</p>
</div>

<div class="flex justify-end mb-4">
    <a href="/sensor/create"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition">
        + Tambah Sensor
    </a>
</div>

<div class="bg-white shadow-lg rounded-xl overflow-hidden">

    <table class="w-full text-left">
        <thead class="bg-blue-100 text-blue-800">
            <tr>
                <th class="p-3 font-semibold">Nama</th>
                <th class="p-3 font-semibold">Lokasi</th>
                <th class="p-3 font-semibold">Tipe</th>
                <th class="p-3 font-semibold">Status</th>
                <th class="p-3 font-semibold text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($data as $s)
            <tr class="border-b hover:bg-blue-50 transition">
                <td class="p-3">{{ $s->nama_sensor }}</td>
                <td class="p-3">{{ $s->lokasi }}</td>
                <td class="p-3">{{ $s->tipe }}</td>

                <!-- Badge Status -->
                <td class="p-3">
                    @if($s->status == 'aktif')
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                            ● Aktif
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                            ● Tidak Aktif
                        </span>
                    @endif
                </td>

                <!-- Aksi -->
                <td class="p-3 text-center">
                    <a href="/sensor/{{ $s->id }}/edit"
                       class="text-blue-600 hover:text-blue-800 font-semibold">
                        Edit
                    </a>

                    <span class="mx-2">|</span>

                    <form method="POST" action="/sensor/{{ $s->id }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-red-600 hover:text-red-800 font-semibold"
                            onclick="return confirm('Hapus sensor ini?')">
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
