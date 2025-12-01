

<?php $__env->startSection('title', 'Edit Chapter'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-3xl mx-auto p-8">

    <h1 class="text-3xl font-bold text-white mb-6">
        Edit Chapter : <?php echo e($chapter->title); ?>

    </h1>

    <form action="<?php echo e(route('guru.modul.chapter.update', $chapter->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>

        <div class="mb-4">
            <label class="text-white">Judul Chapter</label>
            <input type="text" name="title"
                   class="w-full p-2 rounded bg-gray-700 text-white"
                   value="<?php echo e($chapter->title); ?>" required>
        </div>

        <div class="mb-4">
            <label class="text-white">Deskripsi</label>
            <textarea name="description"
                      class="w-full p-2 rounded bg-gray-700 text-white"
                      rows="3"><?php echo e($chapter->description); ?></textarea>
        </div>

        <div class="mb-4">
            <label class="text-white">Konten</label>
            <textarea name="content"
                      class="w-full p-3 rounded bg-gray-700 text-white"
                      rows="4"><?php echo e($chapter->content); ?></textarea>
        </div>

        <div class="mb-4">
            <label class="text-white">URL Video (opsional)</label>
            <input type="text" name="video_url"
                   class="w-full p-2 rounded bg-gray-700 text-white"
                   value="<?php echo e($chapter->video_url); ?>">
        </div>

        <div class="mb-4">
            <label class="text-white">Urutan Chapter</label>
            <input type="number" name="order"
                   class="w-full p-2 rounded bg-gray-700 text-white"
                   value="<?php echo e($chapter->order); ?>" required>
        </div>

        <button class="px-6 py-3 bg-indigo-600 text-white rounded-lg">
            Simpan Perubahan
        </button>

    </form>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guru', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\guru\chapters\edit.blade.php ENDPATH**/ ?>