@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $module->icon }} {{ $module->title }}</h1>
                        <p class="text-gray-600 mt-2">Daftar Siswa Terdaftar</p>
                    </div>
                    <a href="{{ route('modules.teach') }}" class="text-indigo-600 hover:underline">← Kembali</a>
                </div>
            </div>

            <!-- Students Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b-2 border-gray-200">
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">No</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Nama Siswa</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Email</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Progress</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse ($enrollments as $index => $enrollment)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-900">{{ ($enrollments->currentPage() - 1) * 15 + $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $enrollment->user->name }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $enrollment->user->email }}</td>
                                <td class="px-6 py-4">
                                    @if ($enrollment->status === 'completed')
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">✓ Selesai</span>
                                    @elseif ($enrollment->status === 'active')
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">⏳ Aktif</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">✗ Berhenti</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $enrollment->progress }}%"></div>
                                    </div>
                                    <span class="text-sm text-gray-600">{{ $enrollment->progress }}%</span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('enrollments.studentDetail', ['module' => $module, 'enrollment' => $enrollment]) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-semibold">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    Belum ada siswa yang mendaftar modul ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $enrollments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
