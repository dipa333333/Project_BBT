@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Data Sensor</h2>
            <p class="text-sm text-gray-500">Perbarui informasi untuk sensor: <b>{{ $sensor->nama_sensor }}</b></p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <form method="POST" action="{{ route('sensor.update', $sensor->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">

                    <!-- Nama Sensor -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Sensor</label>
                        <input type="text" name="nama_sensor" value="{{ old('nama_sensor', $sensor->nama_sensor) }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 focus:bg-white">
                    </div>

                    <!-- Lokasi & Tipe -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Pemasangan</label>
                            <input type="text" name="lokasi" value="{{ old('lokasi', $sensor->lokasi) }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 focus:bg-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Sensor</label>
                            <input type="text" name="tipe" value="{{ old('tipe', $sensor->tipe) }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 focus:bg-white">
                        </div>
                    </div>

                    <!-- Status (PENTING: Gunakan aktif/nonaktif) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Operasional</label>
                        <div class="relative">
                            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-gray-50 focus:bg-white">
                                <option value="aktif" {{ $sensor->status == 'aktif' ? 'selected' : '' }}>Aktif (Online)</option>
                                <option value="nonaktif" {{ $sensor->status == 'nonaktif' ? 'selected' : '' }}>Non-Aktif (Offline)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 mt-6">
                    <a href="{{ route('sensor.index') }}"
                       class="px-5 py-2 rounded-lg text-gray-600 bg-gray-100 hover:bg-gray-200 font-medium transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-5 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 font-medium shadow-md shadow-blue-600/20 transition">
                        Update Data
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection