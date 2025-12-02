

<?php $__env->startSection('title', 'Leaderboard — ' . $module->title); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">

    <h1 class="text-2xl font-bold mb-6 dark:text-white">
        Leaderboard — <?php echo e($module->title); ?>

    </h1>

    <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-6">

        <table class="w-full text-left">
            <thead>
                <tr class="border-b dark:border-gray-700">
                    <th class="py-2">Peringkat</th>
                    <th>Nama</th>
                    <th>Rata-rata Nilai</th>
                    <th>Chapter Lulus</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $leaderboard; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b dark:border-gray-700">
                    <td class="py-2 font-semibold">
                        <?php echo e($index + 1); ?>

                    </td>

                    <td>
                        <?php echo e($users[$row->user_id]->name ?? 'Unknown'); ?>

                    </td>

                    <td><?php echo e(round($row->avg_score)); ?>%</td>

                    <td><?php echo e($row->passed_count); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">
                        Belum ada peserta.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

    <div class="mt-4">
        <a href="<?php echo e(route('murid.modules.show', $module->id)); ?>" 
           class="text-blue-500 underline">Kembali ke Modul</a>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/dashboard/leaderboard.blade.php ENDPATH**/ ?>