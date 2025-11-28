

<?php $__env->startSection('title', 'Tugas Murid'); ?>

<?php $__env->startSection('content'); ?>
<div class="px-6 py-10 max-w-5xl mx-auto">

    <!-- Header -->
    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
        Tugas Kamu 📝
    </h1>
    <p class="text-gray-600 dark:text-gray-400 mb-8">
        Lihat daftar tugas yang belum dikerjakan & tugas yang sudah kamu selesaikan.
    </p>

    <!-- =======================
         BELUM DIKERJAKAN
    ============================ -->
    <div class="rounded-xl p-6 mb-6 shadow 
                bg-white dark:bg-gray-800">

        <h2 class="text-xl font-semibold 
                   text-indigo-600 dark:text-indigo-400 mb-3">
            Belum Dikerjakan
        </h2>

        <?php if($pending->isEmpty()): ?>
            <p class="text-gray-600 dark:text-gray-400">
                Tidak ada tugas pending 🎉
            </p>
        <?php else: ?>
            <ul class="space-y-3">
                <?php $__currentLoopData = $pending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="p-4 rounded-lg shadow-sm
                               bg-gray-100 dark:bg-gray-700 
                               flex justify-between items-center">

                        <span class="text-gray-800 dark:text-gray-100 font-medium">
                            <?php echo e($p->question ?? 'Tugas #' . $p->id); ?>

                        </span>

                        <a href="#"
                           class="text-indigo-600 dark:text-indigo-400 
                                  font-semibold hover:underline">
                            Kerjakan
                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>

    </div>

    <!-- =======================
         SUDAH SELESAI
    ============================ -->
    <div class="rounded-xl p-6 shadow 
                bg-white dark:bg-gray-800">

        <h2 class="text-xl font-semibold 
                   text-green-600 dark:text-green-400 mb-3">
           Sudah Selesai
        </h2>

        <?php if($done->isEmpty()): ?>
            <p class="text-gray-600 dark:text-gray-400">
                Belum ada tugas yang selesai.
            </p>
        <?php else: ?>
            <ul class="space-y-3">
                <?php $__currentLoopData = $done; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="p-4 rounded-lg shadow-sm
                               bg-gray-100 dark:bg-gray-700 
                               flex justify-between items-center">

                        <span class="text-gray-800 dark:text-gray-100 font-medium">
                            <?php echo e($d->question ?? 'Tugas #' . $d->question_id); ?>

                        </span>

                        <span class="text-green-600 dark:text-green-400 font-semibold">
                            ✔ Selesai
                        </span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\IDN kls 10\lomba-lomba\te\laravel\sgc\resources\views/dashboard/tugas.blade.php ENDPATH**/ ?>