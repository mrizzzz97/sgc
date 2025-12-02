@extends('layouts.guru')

@section('title', 'Profil Guru')

@section('content')

<div class="max-w-3xl mx-auto mt-10">

    {{-- ===================================================== --}}
    {{--  GLOBAL ELEGANT NOTIFICATION                         --}}
    {{-- ===================================================== --}}

    @if (session('success'))
        <div class="mb-4 p-4 rounded-lg text-green-800 bg-green-100 dark:bg-green-900 dark:text-green-200 border border-green-300 dark:border-green-800">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 rounded-lg text-red-800 bg-red-100 dark:bg-red-900 dark:text-red-200 border border-red-300 dark:border-red-800">
            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="mb-4 p-4 rounded-lg text-yellow-800 bg-yellow-100 dark:bg-yellow-900 dark:text-yellow-200 border border-yellow-300 dark:border-yellow-800">
            <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('warning') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 rounded-lg text-red-800 bg-red-100 dark:bg-red-900 dark:text-red-200 border border-red-300 dark:border-red-800">
            <div class="font-semibold mb-1">
                <i class="fas fa-times-circle mr-2"></i> Ada beberapa kesalahan:
            </div>
            <ul class="list-disc ml-5 text-sm space-y-1">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ===================================================== --}}
    {{-- TITLE --}}
    {{-- ===================================================== --}}
    <h1 class="text-2xl font-bold dark:text-white mb-6">Pengaturan Profil</h1>

    {{-- ===================================================== --}}
    {{-- UPDATE PROFILE --}}
    {{-- ===================================================== --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-8">

        <form action="{{ route('guru.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')


            <div class="mb-4">
                <label class="block dark:text-gray-300">Nama</label>
                <input type="text" name="name" value="{{ $user->name }}"
                    class="w-full p-2 rounded bg-gray-100 dark:bg-gray-700 dark:text-white">
            </div>

            <div class="mb-4">
                <label class="block dark:text-gray-300">Email</label>
                <input type="email" name="email" value="{{ $user->email }}"
                    class="w-full p-2 rounded bg-gray-100 dark:bg-gray-700 dark:text-white">
            </div>

            <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Simpan Perubahan
            </button>

        </form>
    </div>

    {{-- ===================================================== --}}
    {{-- UPDATE PASSWORD --}}
    {{-- ===================================================== --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-8">

        <h2 class="text-xl font-semibold mb-4 dark:text-white">Ubah Password</h2>

        <form action="{{ route('profile.password.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block dark:text-gray-300">Password Lama</label>
                <input type="password" name="current_password"
                    class="w-full p-2 rounded bg-gray-100 dark:bg-gray-700 dark:text-white">
            </div>

            <div class="mb-4">
                <label class="block dark:text-gray-300">Password Baru</label>
                <input type="password" name="new_password"
                    class="w-full p-2 rounded bg-gray-100 dark:bg-gray-700 dark:text-white">
            </div>

            <div class="mb-4">
                <label class="block dark:text-gray-300">Konfirmasi Password Baru</label>
                <input type="password" name="new_password_confirmation"
                    class="w-full p-2 rounded bg-gray-100 dark:bg-gray-700 dark:text-white">
            </div>

            <button class="px-4 py-2 bg-yellow-500 text-black rounded-lg hover:bg-yellow-600">
                Update Password
            </button>
        </form>

    </div>

    {{-- ===================================================== --}}
    {{-- DELETE ACCOUNT --}}
    {{-- ===================================================== --}}
    <div class="bg-red-600 p-6 rounded-2xl shadow text-white">

        <h2 class="text-xl font-semibold mb-3">Hapus Akun</h2>

        <form action="{{ route('profile.destroy') }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="mb-3">
                <label>Password untuk konfirmasi</label>
                <input type="password" name="delete_password"
                    class="w-full mt-1 p-2 rounded bg-red-700 text-white placeholder-gray-200">
            </div>

            <button class="px-4 py-2 bg-white text-red-600 font-bold rounded-lg hover:bg-gray-100">
                Hapus Akun Permanen
            </button>
        </form>

    </div>

</div>

@endsection
