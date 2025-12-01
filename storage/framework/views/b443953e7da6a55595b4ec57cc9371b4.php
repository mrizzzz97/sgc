

<?php $__env->startSection('title', 'Edit Profil Murid'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    
    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-100 dark:bg-green-500 border-l-4 border-green-500 dark:border-green-700 text-green-700 dark:text-white rounded-md shadow-lg flex items-center justify-between animate-fade-in">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-green-600 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="font-medium"><?php echo e(session('success')); ?></p>
            </div>
            <button onclick="this.parentElement.style.display='none';" class="text-green-700 dark:text-white hover:opacity-80">
                ✕
            </button>
        </div>
    <?php endif; ?>

    
    <?php if(session('success_password')): ?>
        <div class="mb-6 p-4 bg-blue-100 dark:bg-blue-500 border-l-4 border-blue-500 dark:border-blue-700 text-blue-700 dark:text-white rounded-md shadow-lg flex items-center justify-between animate-fade-in">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-blue-600 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="font-medium"><?php echo e(session('success_password')); ?></p>
            </div>
            <button onclick="this.parentElement.style.display='none';" class="text-blue-700 dark:text-white hover:opacity-80">
                ✕
            </button>
        </div>
    <?php endif; ?>

    
    <?php if($errors->any()): ?>
        <div class="mb-6 p-4 bg-red-100 dark:bg-red-500 border-l-4 border-red-500 dark:border-red-700 text-red-700 dark:text-white rounded-md shadow-lg animate-fade-in">
            <div class="flex items-center mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-red-700 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-semibold">Terjadi Kesalahan!</span>
            </div>
            <ul class="list-disc list-inside mt-2 space-y-1">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">

        
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-white/20 rounded-full p-3 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">Edit Profil Murid</h1>
                    <p class="text-indigo-100 mt-1">Perbarui informasi dan password murid</p>
                </div>
            </div>
        </div>

        <div class="p-6 sm:p-8">

            
            <div class="mb-8">
                <div class="flex items-center mb-4 pb-2 border-b border-gray-300 dark:border-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 dark:text-indigo-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Informasi Profil</h2>
                </div>

                <form method="POST" action="<?php echo e(route('admin.murid.update', $murid->id)); ?>" class="space-y-6">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap</label>
                            <input type="text" name="name"
                                value="<?php echo e(old('name', $murid->name)); ?>"
                                class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-indigo-500">
                        </div>

                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                            <input type="email" name="email"
                                value="<?php echo e(old('email', $murid->email)); ?>"
                                class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-indigo-500">
                        </div>

                    </div>

                    <div class="flex justify-end">
                        <button class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg flex items-center gap-2">
                            ✔ Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            
            <div class="pt-6 border-t border-gray-300 dark:border-gray-700">
                <div class="flex items-center mb-4 pb-2 border-b border-gray-300 dark:border-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 dark:text-indigo-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Ubah Password</h2>
                </div>

                <form method="POST" action="<?php echo e(route('admin.murid.password.update', $murid->id)); ?>" class="space-y-6">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password Baru</label>
                            <input type="password" name="new_password"
                                class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation"
                                class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-indigo-500">
                        </div>

                    </div>

                    <div class="flex justify-end">
                        <button class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg flex items-center gap-2">
                            🔒 Update Password
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in { animation: fade-in 0.5s ease-out; }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\admin\murid\edit.blade.php ENDPATH**/ ?>