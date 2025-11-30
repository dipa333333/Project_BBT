@extends('layouts.app')

@section('content')

<!-- HEADER -->
<div class="mb-6">
    <h2 class="text-3xl font-bold text-blue-700">Edit Sensor</h2>
    <p class="text-gray-600">Perbarui informasi sensor pemantauan air tanah.</p>
</div>

<!-- FORM CARD -->
<form method="POST" action="/sensor/{{ $sensor->id }}"
      class="bg-white p-6 rounded-xl shadow-lg w-full md:w-1/2 space-y-4">

    @csrf
    @method('PUT')

    <!-- NAMA SENSOR -->
    <div>
        <label class="block font-semibold text-gray-700 mb-1">Nama Sensor</label>
        <input type="text" name="nama_sensor"
               class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400"
               value="{{ $sensor->nama_sensor }}">
    </div>

    <!-- LOKASI -->
    <div>
        <label class="block font-semibold text-gray-700 mb-1">Lokasi</label>
        <input type="text" name="lokasi"
               class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400"
               value="{{ $sensor->lokasi }}">
    </div>

    <!-- TIPE -->
    <div>
        <label class="block font-semibold text-gray-700 mb-1">Tipe Sensor</label>
        <input type="text" name="tipe"
               class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400"
               value="{{ $sensor->tipe }}">
    </div>

    <!-- STATUS -->
    <div>
        <label class="block font-semibold text-gray-700 mb-1">Status Sensor</label>
        <select name="status"
                class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400">
            <option value="online"  {{ $sensor->status=='online'?'selected':'' }}>Online</option>
            <option value="offline" {{ $sensor->status=='offline'?'selected':'' }}>Offline</option>
        </select>
    </div>

    <!-- BUTTONS -->
    <div class="flex gap-3 mt-4">
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
            Update
        </button>

        <a href="/sensor"
           class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2 rounded-lg shadow">
            Batal
        </a>
    </div>

</form>

@endsection
