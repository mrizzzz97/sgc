

<?php $__env->startSection('title', 'Chapter Selesai'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-3xl font-bold mb-4 dark:text-white">
        Chapter Selesai 🎉
    </h1>

    <p class="mb-2 dark:text-gray-300">Chapter: <?php echo e($chapter->title); ?></p>
    <p class="mb-6 dark:text-gray-300">Modul: <?php echo e($module->title); ?></p>

    <a href="<?php echo e(route('murid.modules.show', $module->id)); ?>"
       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Kembali ke Modul
    </a>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\dashboard\chapter_finish.blade.php ENDPATH**/ ?>