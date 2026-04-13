@extends('layouts.app')

@section('content')

<h2 class="text-3xl font-bold text-blue-700 flex items-center gap-2">Profil Saya</h2>

@if (session('status') === 'profile-updated')
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        Profil berhasil diperbarui!
    </div>
@endif

<div class="bg-white p-6 rounded-xl shadow w-full md:w-1/2">

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc ml-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <label class="block mb-2 font-semibold">Nama</label>
        <input type="text" name="name"
               class="w-full p-2 border rounded mb-4"
               value="{{ old('name', $user->name) }}">

        <label class="block mb-2 font-semibold">Email</label>
        <input type="email" name="email"
               class="w-full p-2 border rounded mb-4"
               value="{{ old('email', $user->email) }}">

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan Perubahan
        </button>
    </form>

    {{-- ========================================= --}}
{{-- FORM UBAH PASSWORD --}}
{{-- ========================================= --}}
<h3 class="text-xl font-semibold mt-10 mb-3">Ubah Password</h3>

@if (session('status') === 'password-updated')
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        Password berhasil diperbarui!
    </div>
@endif

<div class="bg-white p-6 rounded-xl shadow w-full md:w-1/2">

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <label class="block mb-2 font-semibold">Password Lama</label>
        <input
            type="password"
            name="current_password"
            class="w-full p-2 border rounded mb-4"
            required
        >

        <label class="block mb-2 font-semibold">Password Baru</label>
        <input
            type="password"
            name="password"
            class="w-full p-2 border rounded mb-4"
            required
        >

        <label class="block mb-2 font-semibold">Konfirmasi Password Baru</label>
        <input
            type="password"
            name="password_confirmation"
            class="w-full p-2 border rounded mb-4"
            required
        >

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Perbarui Password
        </button>
    </form>

</div>


</div>

@endsection
