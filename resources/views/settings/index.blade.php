@extends('layouts.app')

@section('content')

<!-- HEADER -->
<div class="mb-8">
    <h2 class="text-3xl font-bold text-blue-700 text-center md:text-left">
        Pengaturan Sistem
    </h2>
    <p class="text-gray-600 text-center md:text-left">
        Atur parameter utama sistem Smart Meter sesuai kebutuhan.
    </p>
</div>

<!-- SETTINGS CARD -->
<div class="bg-white p-6 rounded-2xl shadow w-full md:w-2/3 lg:w-1/2 mx-auto">

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- BATAS MAKS USAGE -->
        <label class="font-semibold text-gray-700">Batas Maksimal Penggunaan</label>
        <p class="text-sm text-gray-500 mb-1">(Liter per hari)</p>
        <input
            type="number"
            name="max_usage"
            class="w-full p-3 border rounded-xl mb-5 focus:ring-2 focus:ring-blue-400"
            placeholder="Contoh: 1000"
            value="{{ old('max_usage', $settings->max_usage ?? 1000) }}"
        >

        <!-- UNIT -->
        <label class="font-semibold text-gray-700">Satuan Pengukuran</label>
        <p class="text-sm text-gray-500 mb-1">Pilih satuan volume yang digunakan sistem.</p>
        <select
            name="unit"
            class="w-full p-3 border rounded-xl mb-5 focus:ring-2 focus:ring-blue-400 bg-white"
        >
            <option value="liter" {{ (old('unit', $settings->unit ?? 'liter') == 'liter') ? 'selected' : '' }}>
                Liter (L)
            </option>

            <option value="m3" {{ (old('unit', $settings->unit ?? '') == 'm3') ? 'selected' : '' }}>
                Meter Kubik (m³)
            </option>
        </select>

        <!-- DARK MODE SWITCH -->
        <label class="font-semibold text-gray-700">Mode Tampilan</label>
        <p class="text-sm text-gray-500 mb-2">Aktifkan mode gelap jika diinginkan.</p>

        <label class="flex items-center cursor-pointer mb-5">

            <!-- SWITCH -->
            <div class="relative">
                <input type="checkbox" name="dark_mode"
                    class="sr-only peer"
                    {{ (old('dark_mode', $settings->dark_mode ?? false)) ? 'checked' : '' }}>

                <div class="w-14 h-8 bg-gray-300 peer-checked:bg-blue-500 rounded-full transition"></div>
                <div class="absolute top-1 left-1 w-6 h-6 bg-white rounded-full shadow
                            transition peer-checked:translate-x-6"></div>
            </div>

            <span class="ml-3 text-gray-700 font-medium">
                Aktifkan Mode Gelap
            </span>
        </label>

        <!-- SUBMIT -->
        <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-xl shadow transition font-semibold"
        >
            Simpan Pengaturan
        </button>
    </form>

</div>

@endsection
