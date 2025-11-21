@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">📚 Daftar Modul Pembelajaran</h1>
                <p class="text-gray-600">Pilih modul yang ingin Anda pelajari dan mulai perjalanan belajar Anda</p>
            </div>

            <!-- Modules Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($modules as $module)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-8">
                            <div class="text-5xl mb-2">{{ $module->icon }}</div>
                            <h3 class="text-2xl font-bold text-white">{{ $module->title }}</h3>
                        </div>
                        
                        <div class="p-6">
                            <p class="text-gray-600 text-sm mb-4">{{ $module->description }}</p>
                            
                            <div class="mb-4">
                                <span class="text-sm text-gray-500 font-semibold">{{ $module->chapters->count() }} Bab</span>
                            </div>

                            @if (in_array($module->id, $userEnrollments))
                                <a href="{{ route('modules.show', $module) }}" class="block w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-center transition">
                                    Lanjutkan Belajar →
                                </a>
                            @else
                                <button onclick="openEnrollModal({{ $module->id }}, '{{ $module->title }}')" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                                    Daftar Modul
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Enrollment Modal -->
<div id="enrollModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
        <h3 class="text-2xl font-bold mb-4">Pilih Guru Pembimbing</h3>
        <p class="text-gray-600 mb-6" id="moduleTitle"></p>
        
        <form id="enrollForm" method="POST" action="">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Guru:</label>
                <select name="teacher_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Pilih Guru --</option>
                    @foreach (\App\Models\User::where('role', 'guru')->get() as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closeEnrollModal()" class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEnrollModal(moduleId, moduleName) {
    document.getElementById('moduleTitle').textContent = moduleName;
    document.getElementById('enrollForm').action = `/modules/${moduleId}/enroll`;
    document.getElementById('enrollModal').classList.remove('hidden');
}

function closeEnrollModal() {
    document.getElementById('enrollModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('enrollModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEnrollModal();
    }
});
</script>
@endsection
