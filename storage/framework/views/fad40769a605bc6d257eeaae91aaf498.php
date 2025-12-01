

<?php $__env->startSection('title', 'Chapter'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">

    <h1 class="text-2xl font-bold mb-4 dark:text-white">
        <?php echo e($chapter->title); ?>

    </h1>

    <p class="text-gray-600 dark:text-gray-300 mb-4">
        <?php echo e($chapter->description); ?>

    </p>

    
    <?php if($chapter->video_url): ?>
        <div class="mb-6">
            <iframe width="100%" height="350"
                    src="https://www.youtube.com/embed/<?php echo e(\Illuminate\Support\Str::after($chapter->video_url, 'v=')); ?>"
                    class="rounded-xl shadow">
            </iframe>
        </div>
    <?php endif; ?>

    
    <div class="prose dark:prose-invert mb-10">
        <?php echo nl2br(e($chapter->content)); ?>

    </div>

    
    <form action="<?php echo e(route('modules.chapter.complete', $chapter->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <button class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow">
            Tandai Selesai
        </button>
    </form>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\dashboard\chapter_show.blade.php ENDPATH**/ ?>