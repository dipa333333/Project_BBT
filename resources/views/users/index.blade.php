@extends('layouts.app')

@section('content')

<div class="mb-6">
    <h2 class="text-3xl font-bold text-blue-700">User Management</h2>
    <p class="text-gray-600">Kelola akun dan peran pengguna di sistem.</p>
</div>

<a href="/users/create"
   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow mb-4 inline-block">
    + Tambah User
</a>

<div class="bg-white rounded-xl shadow overflow-hidden mt-4">

    <table class="w-full border-collapse">
        <thead class="bg-blue-50 border-b">
            <tr>
                <th class="p-3 text-left">User</th>
                <th class="p-3 text-left">Email</th>
                <th class="p-3 text-left">Role</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $u)
            <tr class="hover:bg-blue-50 transition border-b">

                <!-- AVATAR + NAMA -->
                <td class="p-3 flex items-center gap-3">

                    <!-- AVATAR AUTO -->
                    <div class="w-10 h-10 rounded-full bg-blue-200 flex items-center justify-center text-blue-700 font-bold">
                        {{ strtoupper(substr($u->name, 0, 1)) }}
                    </div>

                    <span class="font-semibold">{{ $u->name }}</span>
                </td>

                <!-- EMAIL -->
                <td class="p-3 text-gray-700">{{ $u->email }}</td>

                <!-- ROLE -->
                <td class="p-3">
                    @if($u->role == 'admin')
                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-semibold">Admin</span>
                    @else
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">Staff</span>
                    @endif
                </td>

                <!-- STATUS DUMMY -->
                <td class="p-3">
                    @if(rand(0,1))
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">Online</span>
                    @else
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm">Offline</span>
                    @endif
                </td>

                <!-- AKSI -->
                <td class="p-3 flex gap-2">

                    <a href="/users/{{ $u->id }}/edit"
                       class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200">
                        Edit
                    </a>

                    <form method="POST" action="/users/{{ $u->id }}">
                        @csrf @method('DELETE')
                        <button
                           class="px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200"
                           onclick="return confirm('Hapus user ini?')">
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
