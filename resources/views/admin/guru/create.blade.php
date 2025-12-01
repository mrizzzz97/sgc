@extends('layouts.admin')

@section('title', 'Tambah Guru Baru')

@section('content')

<div class="max-w-4xl mx-auto py-10">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center">
            <div class="bg-indigo-100 dark:bg-indigo-900 rounded-lg p-3 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-6 w-6 text-indigo-600 dark:text-indigo-300" 
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>

            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Tambah Guru Baru
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Lengkapi formulir berikut untuk menambahkan guru.
                </p>
            </div>
        </div>

        <a href="{{ route('admin.guru.index') }}"
           class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-300 dark:hover:text-indigo-200 flex items-center transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/40 border border-red-500 dark:border-red-600 text-red-700 dark:text-red-300 rounded">
            <p class="font-semibold mb-2">Ada {{ count($errors) }} kesalahan:</p>
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- CARD --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-8 transition">

        <form action="{{ route('admin.guru.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- NAMA --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Nama Lengkap
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-900 dark:text-white py-3 px-4 focus:ring-indigo-500 focus:border-indigo-500 transition"
                       placeholder="Nama lengkap guru">
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Email
                </label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-900 dark:text-white py-3 px-4 focus:ring-indigo-500 focus:border-indigo-500 transition"
                       placeholder="email@example.com">
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Password
                </label>
                <input type="password" name="password" required
                       class="w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-900 dark:text-white py-3 px-4 focus:ring-indigo-500 focus:border-indigo-500 transition"
                       placeholder="Minimal 8 karakter">
            </div>

            {{-- KONFIRMASI PASSWORD --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Konfirmasi Password
                </label>
                <input type="password" name="password_confirmation" required
                       class="w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 text-gray-900 dark:text-white py-3 px-4 focus:ring-indigo-500 focus:border-indigo-500 transition"
                       placeholder="Ulangi password">
            </div>

            {{-- ACTION BUTTON --}}
            <div class="flex justify-between items-center pt-6 border-t border-gray-200 dark:border-gray-700">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Password akan terenkripsi otomatis.
                </p>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.guru.index') }}"
                       class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition flex items-center">
                        Batal
                    </a>

                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition">
                        Simpan Guru
                    </button>
                </div>
            </div>

        </form>

    </div>

</div>

@endsection
