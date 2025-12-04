@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">

    <!-- HEADER SECTION -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-blue-700 flex items-center gap-2">
                Notifikasi Sistem
                @if($data->count() > 0)
                    <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded-full border border-red-200">
                        {{ $data->count() }} Baru
                    </span>
                @endif
            </h2>
            <p class="text-sm text-gray-500 mt-1">Pusat informasi peringatan dan status perangkat IoT.</p>
        </div>

        <!-- Tombol Aksi (Optional) -->
        @if($data->count() > 0)
        <button class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1 transition hover:underline">
            <i data-lucide="check-circle" class="w-4 h-4"></i> Tandai semua dibaca
        </button>
        @endif
    </div>

    <!-- LIST CARD WRAPPER -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-5 text-xs font-semibold tracking-wide text-gray-500 uppercase w-1/12">Jenis</th>
                        <th class="p-5 text-xs font-semibold tracking-wide text-gray-500 uppercase w-5/12">Pesan</th>
                        <th class="p-5 text-xs font-semibold tracking-wide text-gray-500 uppercase w-2/12">Waktu</th>
                        <th class="p-5 text-xs font-semibold tracking-wide text-gray-500 uppercase w-2/12">Status</th>
                        <th class="p-5 text-xs font-semibold tracking-wide text-gray-500 uppercase w-1/12 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">

                    @forelse($data as $n)
                    <tr class="hover:bg-blue-50/50 transition duration-200 group">

                        <!-- ICON JENIS -->
                        <td class="p-5">
                            @if($n->tipe == 'warning')
                                <div class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center border border-yellow-200">
                                    <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                                </div>
                            @elseif($n->tipe == 'error')
                                <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center border border-red-200 animate-pulse">
                                    <i data-lucide="x-circle" class="w-5 h-5"></i>
                                </div>
                            @else
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center border border-blue-200">
                                    <i data-lucide="info" class="w-5 h-5"></i>
                                </div>
                            @endif
                        </td>

                        <!-- PESAN -->
                        <td class="p-5">
                            <p class="text-gray-800 font-medium text-sm leading-relaxed">
                                {{ $n->pesan }}
                            </p>
                            @if($n->tipe == 'error')
                                <span class="text-xs text-red-500 mt-1 block">Segera lakukan pengecekan!</span>
                            @endif
                        </td>

                        <!-- WAKTU (Created At) -->
                        <td class="p-5">
                            <div class="flex items-center text-gray-500 text-sm">
                                <i data-lucide="clock" class="w-3 h-3 mr-2"></i>
                                {{ $n->created_at->diffForHumans() }}
                            </div>
                        </td>

                        <!-- STATUS -->
                        <td class="p-5">
                            @if($n->status == 'baru')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-1.5"></span> Baru
                                </span>
                            @elseif($n->status == 'dibaca')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                    Dibaca
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                    Arsip
                                </span>
                            @endif
                        </td>

                        <!-- AKSI -->
                        <td class="p-5 text-right">
                            <form method="POST" action="{{ route('notifikasi.destroy', $n->id) }}"
                                  onsubmit="return confirm('Hapus notifikasi ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors group-hover:text-red-500"
                                        title="Hapus Notifikasi">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                    @empty
                    <!-- EMPTY STATE (Jika Data Kosong) -->
                    <tr>
                        <td colspan="5" class="py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <div class="bg-gray-50 p-4 rounded-full mb-3">
                                    <i data-lucide="bell-off" class="w-8 h-8 text-gray-300"></i>
                                </div>
                                <p class="text-gray-500 font-medium">Tidak ada notifikasi baru</p>
                                <p class="text-xs text-gray-400 mt-1">Sistem berjalan normal tanpa peringatan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- FOOTER / PAGINATION (Jika ada) -->
        <div class="bg-gray-50 px-5 py-3 border-t border-gray-100">
             <span class="text-xs text-gray-400">Menampilkan {{ $data->count() }} notifikasi terakhir.</span>
        </div>

    </div>
</div>

<script>
    // Inisialisasi Icons
    lucide.createIcons();
</script>

@endsection