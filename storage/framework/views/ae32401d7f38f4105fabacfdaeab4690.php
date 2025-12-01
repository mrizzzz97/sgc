

<?php $__env->startSection('title', 'Tambah Modul'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-4xl mx-auto p-10">
    
    <h1 class="text-3xl font-bold mb-6 dark:text-white">
        Tambah Modul Pembelajaran
    </h1>

    <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-8">

        <form method="POST" action="<?php echo e(route('guru.modul.store')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>

            
            <div>
                <label class="block font-semibold mb-2 dark:text-gray-200">Judul Modul</label>
                <input type="text" name="title" required
                       class="w-full border rounded-lg px-4 py-3 dark:bg-gray-700 dark:text-white">
            </div>

            
            <div>
                <label class="block font-semibold mb-2 dark:text-gray-200">Deskripsi</label>
                <textarea name="description" rows="4" required
                          class="w-full border rounded-lg px-4 py-3 dark:bg-gray-700 dark:text-white"></textarea>
            </div>

            
            <div>
                <label class="block font-semibold mb-2 dark:text-gray-200">Ikon</label>
                <input type="text" name="icon" required
                       class="w-full border rounded-lg px-4 py-3 dark:bg-gray-700 dark:text-white"
                       placeholder="Contoh: 📘 atau icon-css">
            </div>

            
            <div>
                <label class="block font-semibold mb-2 dark:text-gray-200">Urutan Modul</label>
                <input type="number" name="order" min="1" required
                       class="w-full border rounded-lg px-4 py-3 dark:bg-gray-700 dark:text-white">
            </div>

            <div class="flex justify-end gap-4">

                <a href="<?php echo e(route('guru.modul.index')); ?>"
                   class="px-5 py-3 bg-gray-300 dark:bg-gray-700 rounded-lg dark:text-white">
                    Batal
                </a>

                <button type="submit"
                        class="px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                    Simpan Modul
                </button>

            </div>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guru', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\guru\modul\create.blade.php ENDPATH**/ ?>