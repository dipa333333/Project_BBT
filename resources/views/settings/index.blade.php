@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">

    <!-- HEADER SECTION -->
    <div class="max-w-3xl mx-auto text-center mb-10">
        <h2 class="text-3xl font-bold text-blue-700 mb-2">Pengaturan Sistem</h2>
        <p class="text-gray-500">Sesuaikan parameter monitoring dan preferensi tampilan aplikasi.</p>
    </div>

    <!-- SETTINGS CARD -->
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <!-- Flash Message -->
        @if(session('success'))
        <div class="bg-green-50 border-b border-green-100 text-green-700 px-6 py-4 flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        @endif

        <form action="{{ route('settings.update') }}" method="POST" class="p-6 md:p-8 space-y-8">
            @csrf
            @method('PUT')

            <!-- SECTION 1: PARAMETER SENSOR -->
            <div>
                <div class="flex items-center gap-3 mb-4 pb-2 border-b border-gray-100">
                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                        <i data-lucide="sliders" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Parameter Sensor</h3>
                </div>

                <div class="space-y-5">
                    <!-- Batas Maksimal -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Batas Peringatan Pemakaian</label>
                        <p class="text-xs text-gray-500 mb-2">Sistem akan mengirim notifikasi jika pemakaian harian melebihi angka ini.</p>

                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="alert-octagon" class="w-5 h-5 text-gray-400"></i>
                            </div>
                            <input
                                type="number"
                                name="max_usage"
                                class="w-full pl-10 pr-16 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="1000"
                                value="{{ old('max_usage', $settings->max_usage ?? 1000) }}"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm font-medium">Liter</span>
                            </div>
                        </div>
                    </div>

                    <!-- Satuan Unit -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Satuan Volume Utama</label>
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Option Liter -->
                            <label class="cursor-pointer">
                                <input type="radio" name="unit" value="liter" class="peer sr-only"
                                    {{ (old('unit', $settings->unit ?? 'liter') == 'liter') ? 'checked' : '' }}>
                                <div class="p-3 rounded-xl border border-gray-200 bg-gray-50 peer-checked:bg-blue-50 peer-checked:border-blue-500 peer-checked:text-blue-700 transition flex items-center gap-3 hover:bg-gray-100">
                                    <div class="bg-white p-1.5 rounded shadow-sm">
                                        <i data-lucide="droplet" class="w-4 h-4 text-blue-500"></i>
                                    </div>
                                    <span class="font-medium text-sm">Liter (L)</span>
                                </div>
                            </label>

                            <!-- Option M3 -->
                            <label class="cursor-pointer">
                                <input type="radio" name="unit" value="m3" class="peer sr-only"
                                    {{ (old('unit', $settings->unit ?? '') == 'm3') ? 'checked' : '' }}>
                                <div class="p-3 rounded-xl border border-gray-200 bg-gray-50 peer-checked:bg-blue-50 peer-checked:border-blue-500 peer-checked:text-blue-700 transition flex items-center gap-3 hover:bg-gray-100">
                                    <div class="bg-white p-1.5 rounded shadow-sm">
                                        <i data-lucide="box" class="w-4 h-4 text-blue-500"></i>
                                    </div>
                                    <span class="font-medium text-sm">Kubik (m³)</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: TAMPILAN -->
            <div>
                <div class="flex items-center gap-3 mb-4 pb-2 border-b border-gray-100">
                    <div class="p-2 bg-purple-50 rounded-lg text-purple-600">
                        <i data-lucide="monitor" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Personalisasi</h3>
                </div>

                <!-- Dark Mode -->
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <div>
                        <h4 class="font-semibold text-gray-800 text-sm">Mode Gelap (Dark Mode)</h4>
                        <p class="text-xs text-gray-500 mt-0.5">Mengurangi cahaya biru untuk kenyamanan mata.</p>
                    </div>

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="dark_mode" class="sr-only peer"
                            {{ (old('dark_mode', $settings->dark_mode ?? false)) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </div>

            <!-- SUBMIT BUTTON -->
            <div class="pt-4">
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg shadow-blue-600/20 transition-all active:scale-[0.98]">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    lucide.createIcons();
</script>

@endsection