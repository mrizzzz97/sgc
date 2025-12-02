

<?php $__env->startSection('content'); ?>
<div class="px-6 py-10 max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold mb-4 dark:text-white">📚 Modul Pembelajaran</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('murid.modules.show', $m->id)); ?>"
               class="p-5 rounded-xl bg-white dark:bg-gray-800 shadow hover:shadow-lg transition">

                <h2 class="text-xl font-semibold dark:text-white"><?php echo e($m->title); ?></h2>
                <p class="text-gray-600 dark:text-gray-300 text-sm mt-2"><?php echo e($m->description); ?></p>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/dashboard/modul.blade.php ENDPATH**/ ?>