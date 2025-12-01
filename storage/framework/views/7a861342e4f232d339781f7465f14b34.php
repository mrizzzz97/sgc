

<?php $__env->startSection('title', 'Tambah Chapter Baru'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-3xl mx-auto p-8">

    <h1 class="text-3xl font-bold text-white mb-6">
        Tambah Chapter untuk Modul: <?php echo e($module->title); ?>

    </h1>

    <form action="<?php echo e(route('guru.modul.chapter.store', $module->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="mb-4">
            <label class="text-white">Judul Chapter</label>
            <input type="text" name="title"
                   class="w-full p-2 rounded bg-gray-700 text-white"
                   placeholder="Masukkan judul chapter..."
                   required>
        </div>

        <div class="mb-4">
            <label class="text-white">Deskripsi</label>
            <textarea name="description"
                      class="w-full p-2 rounded bg-gray-700 text-white"
                      rows="3"
                      placeholder="Isi deskripsi singkat..."></textarea>
        </div>

        <div class="mb-4">
            <label class="text-white">Konten</label>
            <textarea name="content"
                      class="w-full p-3 rounded bg-gray-700 text-white"
                      rows="4"
                      placeholder="Isi konten chapter..."></textarea>
        </div>

        <div class="mb-4">
            <label class="text-white">URL Video (opsional)</label>
            <input type="text" name="video_url"
                   class="w-full p-2 rounded bg-gray-700 text-white"
                   placeholder="https://youtube.com/...">
        </div>

        <div class="mb-4">
            <label class="text-white">Urutan Chapter</label>
            <input type="number" name="order"
                   class="w-full p-2 rounded bg-gray-700 text-white"
                   placeholder="1"
                   required>
        </div>

        <button class="px-6 py-3 bg-indigo-600 text-white rounded-lg">
            Simpan Chapter
        </button>

    </form>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guru', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\guru\chapters\create.blade.php ENDPATH**/ ?>