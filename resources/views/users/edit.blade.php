@extends('layouts.app')

@section('content')

<h2 class="text-3xl font-bold text-blue-700 mb-6">Edit User</h2>

<div class="bg-white p-6 rounded-xl shadow w-full md:w-1/2">

    <form method="POST" action="/users/{{ $user->id }}">
        @csrf @method('PUT')

        <label class="font-semibold">Nama</label>
        <input type="text" name="name" value="{{ $user->name }}" required
               class="w-full p-2 border rounded mb-3">

        <label class="font-semibold">Email</label>
        <input type="email" name="email" value="{{ $user->email }}" required
               class="w-full p-2 border rounded mb-3">

        <label class="font-semibold">Password (opsional)</label>
        <input type="password" name="password"
               class="w-full p-2 border rounded mb-3">

        <label class="font-semibold">Role</label>
        <select name="role" class="w-full p-2 border rounded mb-3">
            <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
            <option value="staff" {{ $user->role=='staff'?'selected':'' }}>Staff</option>
        </select>

        <button class="bg-green-600 text-white px-4 py-2 rounded-lg">Update</button>
    </form>
</div>

@endsection
