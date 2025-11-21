@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-8 mb-8 flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">👨‍🏫 Modul untuk Pengajaran</h1>
                    <p class="text-gray-600 mt-2">Kelola modul, chapter, dan soal untuk siswa Anda</p>
                </div>
                <a href="{{ route('modules.create') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
                    + Buat Modul Baru
                </a>
            </div>

            <!-- Statistic Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-4 flex items-center gap-4">
                    <div class="bg-indigo-100 text-indigo-700 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Modul dikelola</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalManagedModules ?? $modules->total() }}</div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-4 flex items-center gap-4">
                    <div class="bg-green-100 text-green-700 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.89 0 5.56.84 7.879 2.276M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Total Siswa</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalStudents ?? 0 }}</div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-4 flex items-center gap-4">
                    <div class="bg-amber-100 text-amber-700 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a6 6 0 11-12 0 6 6 0 0112 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Sertifikat Dikeluarkan</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalCertificates ?? 0 }}</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($modules as $module)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-8">
                            <div class="text-4xl mb-2">{{ $module->icon }}</div>
                            <h3 class="text-xl font-bold text-white">{{ $module->title }}</h3>
                        </div>
                        
                        <div class="p-6">
                            <p class="text-gray-600 text-sm mb-4">{{ $module->description }}</p>
                            <div class="mb-4">
                                <span class="text-sm text-gray-500">{{ $module->chapters->count() }} Bab</span>
                                <span class="ml-3 inline-block bg-indigo-100 text-indigo-800 text-xs font-semibold px-2 py-1 rounded">Siswa: {{ $module->enrollments_count ?? 0 }}</span>
                            </div>
                            
                            <!-- Actions -->
                            <div class="space-y-2">
                                <a href="{{ route('enrollments.students', $module) }}" 
                                   class="block w-full bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 text-center transition text-sm">
                                    Lihat Siswa
                                </a>
                                <a href="{{ route('modules.edit', $module) }}" 
                                   class="block w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 text-center transition text-sm">
                                    Edit Modul
                                </a>
                                <a href="{{ route('chapters.create', $module) }}" 
                                   class="block w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 text-center transition text-sm">
                                    + Tambah Bab
                                </a>
                                
                                @if ($module->chapters->count() > 0)
                                    <div class="bg-gray-50 rounded-lg p-3 mt-3">
                                        <p class="text-xs font-semibold text-gray-700 mb-2">Bab:</p>
                                        <ul class="space-y-2">
                                            @foreach ($module->chapters as $chapter)
                                                <li class="text-xs text-gray-600 flex justify-between items-center">
                                                    <span>{{ $chapter->title }} ({{ $chapter->questions->count() }} soal)</span>
                                                    <div class="flex gap-1">
                                                        <a href="{{ route('chapters.edit', $chapter) }}" class="text-blue-600 hover:text-blue-800 text-xs">
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('chapters.destroy', $chapter) }}" method="POST" class="inline" onsubmit="return confirm('Hapus bab ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-800 text-xs">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                
                                <form action="{{ route('modules.destroy', $module) }}" method="POST" onsubmit="return confirm('Hapus modul ini? Semua bab dan soal akan terhapus.');" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-sm transition">
                                        Hapus Modul
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Recent Enrollments / Activity -->
            <div class="mt-8 bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Aktivitas Terbaru</h2>
                @if(isset($recentEnrollments) && $recentEnrollments->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($recentEnrollments as $enroll)
                            <div class="p-4 border rounded flex items-center justify-between">
                                <div>
                                    <div class="text-sm text-gray-600">{{ $enroll->created_at->diffForHumans() }}</div>
                                    <div class="text-sm font-semibold text-gray-900">{{ $enroll->user->name }} enrolled</div>
                                    <div class="text-xs text-gray-500">Modul: {{ $enroll->module->title }}</div>
                                </div>
                                <div>
                                    <a href="{{ route('enrollments.studentDetail', ['module' => $enroll->module, 'enrollment' => $enroll]) }}" class="text-indigo-600 hover:underline text-sm">Lihat</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500">Belum ada aktivitas baru. Ajak siswa untuk mendaftar atau buat soal baru untuk memulai interaksi.</p>
                @endif
            </div>

            <!-- Right column: Top students and recent answers -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-md font-semibold text-gray-900 mb-3">Top Siswa (Berdasarkan XP)</h3>
                    @if(isset($topStudents) && $topStudents->count() > 0)
                        <ul class="space-y-3">
                            @foreach($topStudents as $student)
                                <li class="flex items-center justify-between">
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $student->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $student->email }}</div>
                                    </div>
                                    <div class="text-sm font-bold text-indigo-700">{{ $student->daily_xps_sum_points ?? 0 }} XP</div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-500">Belum ada data siswa.</p>
                    @endif
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-md font-semibold text-gray-900 mb-3">Jawaban Terbaru</h3>
                    @if(isset($recentAnswers) && $recentAnswers->count() > 0)
                        <ul class="space-y-3 text-sm">
                            @foreach($recentAnswers as $ans)
                                <li class="flex items-start justify-between">
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ Str::limit($ans->question->question_text ?? 'Pertanyaan tidak ditemukan', 60) }}</div>
                                        <div class="text-xs text-gray-500">{{ $ans->user->name }} — {{ $ans->created_at->diffForHumans() }}</div>
                                    </div>
                                    <div class="text-xs font-semibold {{ $ans->is_correct ? 'text-green-600' : ($ans->is_correct === null ? 'text-yellow-600' : 'text-red-600') }}">
                                        @if($ans->is_correct)
                                            ✓
                                        @elseif($ans->is_correct === null)
                                            ⏳
                                        @else
                                            ✗
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-500">Belum ada jawaban terbaru.</p>
                    @endif
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $modules->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
