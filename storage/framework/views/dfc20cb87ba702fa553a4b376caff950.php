

<?php $__env->startSection('title', 'Detail Modul'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">

    <h1 class="text-2xl font-bold mb-6 dark:text-white">
        <?php echo e($module->title); ?>

    </h1>

    <p class="text-gray-600 dark:text-gray-300 mb-6">
        <?php echo e($module->description); ?>

    </p>

    <h2 class="text-xl font-semibold mb-4 dark:text-white">
        Daftar Chapter
    </h2>

    <div class="space-y-3">
        <?php $__empty_1 = true; $__currentLoopData = $module->chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('murid.modules.page', ['chapter' => $c->id, 'page' => 1])); ?>"
               class="block p-4 rounded-lg bg-white dark:bg-gray-800 shadow hover:bg-gray-50 dark:hover:bg-gray-700">
                <p class="font-semibold dark:text-white"><?php echo e($c->title); ?></p>
                <p class="text-sm text-gray-500 dark:text-gray-300"><?php echo e($c->description); ?></p>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-500 dark:text-gray-300">Belum ada chapter.</p>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\dashboard\modul_show.blade.php ENDPATH**/ ?>