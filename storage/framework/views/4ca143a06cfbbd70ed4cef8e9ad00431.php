

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-100">
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900"><?php echo e($module->icon); ?> <?php echo e($module->title); ?></h1>
                        <p class="text-gray-600 mt-2">Daftar Siswa Terdaftar</p>
                    </div>
                    <a href="<?php echo e(route('modules.teach')); ?>" class="text-indigo-600 hover:underline">← Kembali</a>
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
                        <?php $__empty_1 = true; $__currentLoopData = $enrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-900"><?php echo e(($enrollments->currentPage() - 1) * 15 + $index + 1); ?></td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900"><?php echo e($enrollment->user->name); ?></div>
                                </td>
                                <td class="px-6 py-4 text-gray-600"><?php echo e($enrollment->user->email); ?></td>
                                <td class="px-6 py-4">
                                    <?php if($enrollment->status === 'completed'): ?>
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">✓ Selesai</span>
                                    <?php elseif($enrollment->status === 'active'): ?>
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">⏳ Aktif</span>
                                    <?php else: ?>
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">✗ Berhenti</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: <?php echo e($enrollment->progress); ?>%"></div>
                                    </div>
                                    <span class="text-sm text-gray-600"><?php echo e($enrollment->progress); ?>%</span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="<?php echo e(route('enrollments.studentDetail', ['module' => $module, 'enrollment' => $enrollment])); ?>" class="text-indigo-600 hover:text-indigo-900 text-sm font-semibold">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    Belum ada siswa yang mendaftar modul ini
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                <?php echo e($enrollments->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\enrollments\students.blade.php ENDPATH**/ ?>