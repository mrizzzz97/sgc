@extends('layouts.admin')

@section('title', 'Daftar Guru')

@section('content')

<div class="max-w-7xl mx-auto py-10">

    {{-- HEADER ADMIN --}}
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Daftar Guru
            </h1>
        </div>

        <a href="{{ route('guru.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 transition flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Guru
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if ($message = Session::get('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-600 text-green-700 rounded">
            {{ $message }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">

        <div class="p-6">
            @if ($gurus->count() > 0)

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    No
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($gurus as $guru)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4 flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-500/30 flex items-center justify-center">
                                            <span class="text-indigo-700 dark:text-indigo-300 font-semibold text-lg">
                                                {{ strtoupper(substr($guru->name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <span class="ml-3 text-gray-900 dark:text-gray-100 font-medium">
                                            {{ $guru->name }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-gray-800 dark:text-gray-200">
                                        {{ $guru->email }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('guru.edit', $guru->id) }}"
                                           class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-semibold mr-3">
                                            Edit
                                        </a>
                                        <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                onclick="return confirm('Yakin ingin menghapus guru ini?')"
                                                class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 font-semibold">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <div class="mt-6">
                    {{ $gurus->links() }}
                </div>

            @else
                <div class="text-center py-10 text-gray-500 dark:text-gray-300">
                    Belum ada data guru.
                </div>
            @endif
        </div>

    </div>

</div>

@endsection
