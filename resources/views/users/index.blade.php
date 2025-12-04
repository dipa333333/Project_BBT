@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">

    <!-- HEADER SECTION -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                Manajemen Pengguna
            </h2>
            <p class="text-sm text-gray-500 mt-1">Kelola akun, hak akses, dan peran pengguna sistem.</p>
        </div>

        <a href="{{ route('users.create') }}"
           class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-medium transition shadow-lg shadow-blue-600/20">
            <i data-lucide="user-plus" class="w-4 h-4"></i>
            <span>Tambah User</span>
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center shadow-sm">
        <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
        {{ session('success') }}
    </div>
    @endif

    <!-- TABLE CARD -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-5 text-xs font-semibold tracking-wide text-gray-500 uppercase">User</th>
                        <th class="p-5 text-xs font-semibold tracking-wide text-gray-500 uppercase">Email</th>
                        <th class="p-5 text-xs font-semibold tracking-wide text-gray-500 uppercase">Role</th>
                        <th class="p-5 text-xs font-semibold tracking-wide text-gray-500 uppercase">Status</th>
                        <th class="p-5 text-xs font-semibold tracking-wide text-gray-500 uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">

                    @foreach($users as $u)
                    <tr class="hover:bg-blue-50/50 transition duration-150 group">

                        <!-- USER INFO -->
                        <td class="p-5">
                            <div class="flex items-center gap-3">
                                <!-- Avatar Inisial -->
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center text-blue-700 font-bold border border-blue-100 shadow-sm">
                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $u->name }}</p>
                                    <p class="text-xs text-gray-400">ID: #{{ $u->id }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- EMAIL -->
                        <td class="p-5 text-sm text-gray-600">
                            <div class="flex items-center gap-2">
                                <i data-lucide="mail" class="w-3 h-3 text-gray-400"></i>
                                {{ $u->email }}
                            </div>
                        </td>

                        <!-- ROLE -->
                        <td class="p-5">
                            @if($u->role == 'admin')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700 border border-red-200">
                                    <i data-lucide="shield-alert" class="w-3 h-3"></i> Admin
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700 border border-blue-200">
                                    <i data-lucide="user" class="w-3 h-3"></i> Staff
                                </span>
                            @endif
                        </td>

                        <!-- STATUS (Dummy Logic) -->
                        <td class="p-5">
                            @if(rand(0,1))
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Online
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Offline
                                </span>
                            @endif
                        </td>

                        <!-- AKSI -->
                        <td class="p-5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('users.edit', $u->id) }}"
                                   class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                   title="Edit User">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </a>

                                <form method="POST" action="{{ route('users.destroy', $u->id) }}"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $u->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                            title="Hapus User">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <!-- Pagination Footer (Jika ada) -->
        <div class="bg-gray-50 px-5 py-3 border-t border-gray-100">
            <span class="text-xs text-gray-400">Total Pengguna: {{ count($users) }}</span>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>

@endsection