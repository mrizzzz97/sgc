

<?php $__env->startSection('title', 'Tambah Murid Baru'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-4xl mx-auto">

    
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-4">
            <div class="bg-indigo-600/20 dark:bg-indigo-900 p-3 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-7 w-7 text-indigo-500 dark:text-indigo-300"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Tambah Murid Baru
                </h1>
                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">
                    Isi data lengkap murid di bawah ini.
                </p>
            </div>
        </div>

        <a href="<?php echo e(route('admin.murid.index')); ?>"
           class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 
                  text-gray-700 dark:text-gray-200 
                  hover:bg-gray-300 dark:hover:bg-gray-600 
                  flex items-center transition">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>

    
    <?php if($errors->any()): ?>
        <div class="mb-6 p-4 bg-red-100 dark:bg-red-800/40 
                    text-red-700 dark:text-red-300 
                    border border-red-300 dark:border-red-600 
                    rounded-lg">
            <h3 class="font-semibold mb-2">
                Terdapat <?php echo e(count($errors)); ?> kesalahan:
            </h3>
            <ul class="list-disc pl-5">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($err); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow 
                border border-gray-200 dark:border-gray-700">

        <form method="POST" action="<?php echo e(route('admin.murid.store')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            
            
            <div>
                <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">
                    Nama Lengkap
                </label>
                <input type="text" name="name" value="<?php echo e(old('name')); ?>"
                       class="w-full px-4 py-3 rounded-lg 
                              bg-white dark:bg-gray-900 
                              text-gray-900 dark:text-white 
                              border border-gray-300 dark:border-gray-700"
                       placeholder="Contoh: Bambang Setiawan" required>
            </div>

            
            <div>
                <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">
                    Email
                </label>
                <input type="email" name="email" value="<?php echo e(old('email')); ?>"
                       class="w-full px-4 py-3 rounded-lg 
                              bg-white dark:bg-gray-900 
                              text-gray-900 dark:text-white 
                              border border-gray-300 dark:border-gray-700"
                       placeholder="email@example.com" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                
                <div>
                    <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">
                        Password
                    </label>
                    <input type="password" name="password"
                           class="w-full px-4 py-3 rounded-lg
                                  bg-white dark:bg-gray-900
                                  text-gray-900 dark:text-white
                                  border border-gray-300 dark:border-gray-700"
                           placeholder="Minimal 6 karakter" required>
                </div>

                
                <div>
                    <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">
                        Konfirmasi Password
                    </label>
                    <input type="password" name="password_confirmation"
                           class="w-full px-4 py-3 rounded-lg
                                  bg-white dark:bg-gray-900
                                  text-gray-900 dark:text-white
                                  border border-gray-300 dark:border-gray-700"
                           placeholder="Ulangi password" required>
                </div>

            </div>

            
            <div class="flex justify-end mt-8">
                <button class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 
                               text-white rounded-lg font-semibold transition">
                    Simpan Murid
                </button>
            </div>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/admin/murid/create.blade.php ENDPATH**/ ?>