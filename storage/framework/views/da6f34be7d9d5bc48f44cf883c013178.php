

<?php $__env->startSection('title', 'Daftar Chapter'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-5xl mx-auto p-10">

    <h1 class="text-3xl font-bold dark:text-white mb-6">
        Chapter Modul: <?php echo e($module->title); ?>

    </h1>

    <a href="<?php echo e(route('guru.modul.chapter.create', $module->id)); ?>"
       class="px-5 py-3 bg-indigo-600 text-white rounded-lg mb-6 inline-block">
        + Tambah Chapter
    </a>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
        <?php if($module->chapters->isEmpty()): ?>
            <p class="text-gray-500 dark:text-gray-300">Belum terdapat chapter.</p>
        <?php else: ?>
            <div class="space-y-4">
                <?php $__currentLoopData = $module->chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-4 border dark:border-gray-700 rounded-lg flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-bold dark:text-white">
                                <?php echo e($c->order); ?>. <?php echo e($c->title); ?>

                            </h2>
                            <p class="text-sm text-gray-500 dark:text-gray-300">
                                <?php echo e(Str::limit(strip_tags($c->description), 100)); ?>

                            </p>
                        </div>

                        <div class="flex gap-3">
                            <a href="<?php echo e(route('guru.modul.chapter.edit', $c->id)); ?>"
                               class="px-3 py-2 bg-gray-600 text-white rounded-lg text-sm">
                                Edit
                            </a>

                            <a href="<?php echo e(route('guru.modul.chapter.pages.index', $c->id)); ?>"
                               class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm">
                                Kelola Halaman
                            </a>

                            <form action="<?php echo e(route('guru.modul.chapter.delete', $c->id)); ?>"
                                  method="POST"
                                  onsubmit="return confirm('Hapus chapter ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="px-3 py-2 bg-red-600 text-white rounded-lg text-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guru', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\IDN kls 10\lomba-lomba\te\laravel\sgc\resources\views/guru/chapters/index.blade.php ENDPATH**/ ?>