@extends('layouts.app')

@section('content')

<!-- HEADER -->
<div class="mb-6">
    <h2 class="text-3xl font-bold text-blue-700">Tambah Sensor</h2>
    <p class="text-gray-600">Masukkan data sensor baru untuk sistem monitoring Smart Meter.</p>
</div>

<!-- FORM CARD -->
<form method="POST" action="/sensor"
      class="bg-white p-6 rounded-xl shadow-lg w-full md:w-1/2 space-y-4">

    @csrf

    <!-- NAMA SENSOR -->
    <div>
        <label class="block font-semibold text-gray-700 mb-1">Nama Sensor</label>
        <input type="text" name="nama_sensor" placeholder="Contoh: Flowmeter Utama"
               class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400">
    </div>

    <!-- LOKASI -->
    <div>
        <label class="block font-semibold text-gray-700 mb-1">Lokasi</label>
        <input type="text" name="lokasi" placeholder="Contoh: Gedung A, Lantai 2"
               class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400">
    </div>

    <!-- TIPE -->
    <div>
        <label class="block font-semibold text-gray-700 mb-1">Tipe Sensor</label>
        <input type="text" name="tipe" value="Flowmeter"
               class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400">
    </div>

    <!-- STATUS -->
    <div>
        <label class="block font-semibold text-gray-700 mb-1">Status</label>
        <select name="status"
                class="w-full p-2 border rounded bg-white focus:ring-2 focus:ring-blue-400">
            <option value="online">Online</option>
            <option value="offline">Offline</option>
        </select>
    </div>

    <!-- BUTTON -->
    <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
        Simpan Sensor
    </button>

</form>

@endsection
