

<?php $__env->startSection('title', $chapter->title); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-4xl mx-auto">

    <!-- Title -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-6">
        <h1 class="text-2xl font-bold dark:text-white"><?php echo e($chapter->title); ?></h1>
        <p class="text-gray-600 dark:text-gray-300 mt-1">
            Modul: <?php echo e($chapter->module->title); ?>

        </p>
    </div>

    <!-- VIDEO -->
    <?php if($chapter->video_url): ?>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-6">
            <h2 class="font-semibold mb-3 dark:text-white">Video Pembelajaran</h2>

            <div class="aspect-video w-full rounded-xl overflow-hidden bg-black">
                <iframe 
                    src="<?php echo e(str_replace('watch?v=', 'embed/', $chapter->video_url)); ?>"
                    class="w-full h-full"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    <?php endif; ?>

    <!-- CONTENT -->
    <?php if($chapter->content): ?>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-6">
            <h2 class="font-semibold mb-3 dark:text-white">Materi</h2>
            <div class="prose dark:prose-invert max-w-none">
                <?php echo nl2br(e($chapter->content)); ?>

            </div>
        </div>
    <?php endif; ?>

    <!-- BUTTON NEXT -->
    <div class="flex justify-end mt-6">
        <form 
            action="<?php echo e(route('murid.modules.page.complete', [
                'chapter' => $chapter->id, 
                'page' => $page->page_number
            ])); ?>" 
            method="POST"
        >
            <?php echo csrf_field(); ?>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                Tandai Selesai & Lanjut
            </button>
        </form>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\dashboard\chapter.blade.php ENDPATH**/ ?>