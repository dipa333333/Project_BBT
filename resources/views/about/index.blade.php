@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto p-4 md:p-6">

    {{-- Judul & Subjudul --}}
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-blue-700">Tentang Aplikasi</h2>
        <p class="text-gray-600 leading-relaxed">Informasi mengenai aplikasi Smart Metering Air Tanah.</p>
    </div>

    {{-- Konten --}}
    <div class="bg-white rounded-xl shadow-md p-6 md:p-8">
        {{-- Nama Aplikasi --}}
        <h3 class="text-xl font-bold mb-2">Nama Aplikasi:</h3>
        <p class="mb-4 text-gray-700 leading-relaxed">Smart Metering Air Tanah (versi awal)</p>

        {{-- Deskripsi --}}
        <h3 class="text-xl font-bold mb-2">Deskripsi:</h3>
        <p class="mb-4 text-gray-700 leading-relaxed">
            Aplikasi ini digunakan untuk memonitor penggunaan air tanah secara real-time,
            mengelola sensor IoT, dan memberikan notifikasi otomatis.
        </p>

        {{-- Pengembang --}}
        <h3 class="text-xl font-bold mb-2">Dikembangkan Oleh:</h3>
        <p class="mb-4 text-gray-700 leading-relaxed">
            Anak Agung Putu Jaya Dipa <br>
            Kadek Gede Damaryana <br>
            Putu Adi Iswara

        </p>

        {{-- Tujuan Proyek --}}
        <h3 class="text-xl font-bold mb-2">Tujuan Proyek:</h3>
        <p class="mb-4 text-gray-700 leading-relaxed">
            Mendigitalisasi pemantauan air tanah agar lebih efisien, akurat, transparan, dan modern.
        </p>

        {{-- Kontak --}}
        <h3 class="text-xl font-bold mb-2">Kontak:</h3>
        <p class="flex items-center mb-4 text-gray-700">
            <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2.94 6.94A2 2 0 0 1 4 6h12a2 2 0 0 1 1.06.94L10 11 2.94 6.94z" />
                <path d="M18 8.11V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.11l8 5 8-5z" />
            </svg>
            example@email.com
        </p>
    </div>

</div>

@endsection
