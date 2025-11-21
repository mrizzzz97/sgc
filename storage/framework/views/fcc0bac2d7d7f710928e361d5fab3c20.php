

<?php $__env->startSection('content'); ?>
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
                <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-8">
                            <div class="text-5xl mb-2"><?php echo e($module->icon); ?></div>
                            <h3 class="text-2xl font-bold text-white"><?php echo e($module->title); ?></h3>
                        </div>
                        
                        <div class="p-6">
                            <p class="text-gray-600 text-sm mb-4"><?php echo e($module->description); ?></p>
                            
                            <div class="mb-4">
                                <span class="text-sm text-gray-500 font-semibold"><?php echo e($module->chapters->count()); ?> Bab</span>
                            </div>

                            <?php if(in_array($module->id, $userEnrollments)): ?>
                                <a href="<?php echo e(route('modules.show', $module)); ?>" class="block w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-center transition">
                                    Lanjutkan Belajar →
                                </a>
                            <?php else: ?>
                                <button onclick="openEnrollModal(<?php echo e($module->id); ?>, '<?php echo e($module->title); ?>')" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                                    Daftar Modul
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Guru:</label>
                <select name="teacher_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Pilih Guru --</option>
                    <?php $__currentLoopData = \App\Models\User::where('role', 'guru')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guru): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($guru->id); ?>"><?php echo e($guru->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\IDN kls 10\lomba-lomba\te\laravel\sgc\resources\views/modules/index.blade.php ENDPATH**/ ?>