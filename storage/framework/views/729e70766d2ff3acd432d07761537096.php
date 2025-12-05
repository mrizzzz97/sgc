

<?php $__env->startSection('title', 'Leaderboard — ' . $module->title); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">

    <!-- Judul -->
    <h1 class="text-3xl font-bold mb-6 dark:text-white">
        Leaderboard — <?php echo e($module->title); ?>

    </h1>

    <!-- Card Leaderboard -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-6 border border-gray-200/60 dark:border-gray-700/60
                transition-all duration-300 hover:shadow-xl hover:-translate-y-1">

        <table class="w-full text-left">
            <thead class="bg-gray-100/60 dark:bg-gray-700/40 backdrop-blur">
                <tr class="border-b dark:border-gray-600 text-gray-600 dark:text-gray-300">
                    <th class="py-3 px-3">Peringkat</th>
                    <th class="py-3 px-3">Nama</th>
                    <th class="py-3 px-3">Rata-rata Nilai</th>
                    <th class="py-3 px-3">Chapter Lulus</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $leaderboard; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b dark:border-gray-700 transition-all duration-200
                           hover:bg-indigo-50 dark:hover:bg-indigo-900/40 hover:translate-x-1">
                    
                    <!-- Rank -->
                    <td class="py-3 px-3 font-semibold 
                               <?php if($index == 0): ?> text-yellow-600 dark:text-yellow-400
                               <?php elseif($index == 1): ?> text-gray-500 dark:text-gray-300
                               <?php elseif($index == 2): ?> text-orange-600 dark:text-orange-400
                               <?php else: ?> text-indigo-600 dark:text-indigo-300 <?php endif; ?>">
                        #<?php echo e($index + 1); ?>

                    </td>

                    <!-- Nama -->
                    <td class="py-3 px-3 dark:text-white font-medium">
                        <?php echo e($users[$row->user_id]->name ?? 'Unknown'); ?>

                    </td>

                    <!-- Nilai Rata-rata -->
                    <td class="py-3 px-3 dark:text-white font-semibold">
                        <?php echo e(round($row->avg_score)); ?>%
                    </td>

                    <!-- Chapter Lulus -->
                    <td class="py-3 px-3">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                                     bg-indigo-100 dark:bg-indigo-800
                                     text-indigo-700 dark:text-indigo-200">
                            <?php echo e($row->passed_count); ?>

                        </span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500 dark:text-gray-400">
                        Belum ada peserta mengikuti modul ini.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

    <!-- Tombol kembali -->
    <div class="mt-6">
        <a href="<?php echo e(route('murid.modules.show', $module->id)); ?>"
        class="inline-block px-5 py-2.5 rounded-lg font-semibold 
                bg-indigo-600 hover:bg-indigo-700 
                text-white shadow-md transition-all duration-200 
                hover:shadow-lg hover:-translate-y-0.5">
            Kembali ke Modul
        </a>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/dashboard/leaderboard.blade.php ENDPATH**/ ?>