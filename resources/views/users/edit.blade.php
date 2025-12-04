@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">

        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Data User</h2>
            <p class="text-sm text-gray-500">Perbarui informasi akun untuk: <b>{{ $user->name }}</b></p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="user" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="mail" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                </div>

                <!-- Grid untuk Password & Role -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Password Baru</label>
                        <p class="text-xs text-gray-500 mb-2">(Kosongkan jika tidak ingin mengganti)</p>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                            </div>
                            <input type="password" name="password" placeholder="******"
                                   class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 mt-0 md:mt-6">Role (Peran)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="shield" class="w-5 h-5 text-gray-400"></i>
                            </div>
                            <select name="role" class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('users.index') }}"
                       class="px-5 py-2.5 rounded-xl text-gray-600 bg-gray-100 hover:bg-gray-200 font-medium transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-5 py-2.5 rounded-xl text-white bg-blue-600 hover:bg-blue-700 font-medium shadow-lg shadow-blue-600/20 transition flex items-center gap-2">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Update User
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>

@endsection