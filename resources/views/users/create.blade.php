@extends('layouts.app')

@section('content')

<h2 class="text-3xl font-bold text-blue-700 mb-6">Tambah User</h2>

<div class="bg-white p-6 rounded-xl shadow w-full md:w-1/2">

    <form method="POST" action="/users">
        @csrf

        <label class="font-semibold">Nama</label>
        <input type="text" name="name" required
               class="w-full p-2 border rounded mb-3">

        <label class="font-semibold">Email</label>
        <input type="email" name="email" required
               class="w-full p-2 border rounded mb-3">

        <label class="font-semibold">Password</label>
        <input type="password" name="password" required
               class="w-full p-2 border rounded mb-3">

        <label class="font-semibold">Role</label>
        <select name="role" class="w-full p-2 border rounded mb-3">
            <option value="admin">Admin</option>
            <option value="staff" selected>Staff</option>
        </select>

        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">Simpan</button>
    </form>
</div>

@endsection
