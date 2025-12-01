

<?php $__env->startSection('title', 'Kelola Modul'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-6xl mx-auto p-10">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold dark:text-white">
            Kelola Modul Pembelajaran
        </h1>

        <a href="<?php echo e(route('guru.modul.create')); ?>"
           class="px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
            + Tambah Modul
        </a>
    </div>


    <!-- LIST MODUL -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <?php $__empty_1 = true; $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">

                <h2 class="text-xl font-bold dark:text-white">
                    <?php echo e($m->title); ?>

                </h2>

                <p class="text-gray-600 dark:text-gray-300 mt-2 text-sm">
                    <?php echo e($m->description); ?>

                </p>

                <div class="flex gap-2 mt-5">

                    <!-- Kelola Chapter -->
                    <a href="<?php echo e(route('guru.modul.chapter.index', $m->id)); ?>"
                       class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm">
                        Kelola Chapter
                    </a>


                    <!-- Edit Modul -->
                    <a href="<?php echo e(route('guru.modul.edit', $m->id)); ?>"
                       class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg text-sm">
                        Edit Modul
                    </a>

                    <!-- Delete -->
                    <form action="<?php echo e(route('guru.modul.destroy', $m->id)); ?>"
                          method="POST"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus modul ini?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>

                        <button class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm">
                            Hapus
                        </button>
                    </form>
                </div>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

            <p class="col-span-2 text-center py-10 text-gray-500 dark:text-gray-300">
                Belum terdapat modul. Silakan tambahkan modul baru.
            </p>

        <?php endif; ?>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guru', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\guru\modul\index.blade.php ENDPATH**/ ?>