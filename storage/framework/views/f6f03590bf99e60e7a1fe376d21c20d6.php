

<?php $__env->startSection('title', 'Daftar Guru'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-7xl mx-auto animate-fade-in">

    
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 gap-4">
        <div class="flex items-center gap-4">

            
            <div class="bg-indigo-100 dark:bg-indigo-900 p-3 rounded-xl transition-all duration-300 hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-7 w-7 text-indigo-600 dark:text-indigo-300" 
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M17 20h5v-2a3 3 0 00-3-3h-1v-2a5 5 0 10-10 0v2H7a3 3 0 00-3 3v2h5" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M9 7a3 3 0 116 0 3 3 0 01-6 0z" />
                </svg>
            </div>

            
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white animate-slide-down">
                    Daftar Guru
                </h1>
                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1 animate-slide-down animation-delay-100">
                    Manajemen akun guru.
                </p>
            </div>
        </div>

        <a href="<?php echo e(route('admin.guru.create')); ?>"
           class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center shadow animate-slide-up">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" 
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 4v16m8-8H4" />
            </svg>
            Tambah Guru
        </a>
    </div>

    
    <?php if($message = Session::get('success')): ?>
        <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-green-700 dark:text-green-300 rounded-lg flex items-center animate-bounce-in">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" 
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <?php echo e($message); ?>

        </div>
    <?php endif; ?>

    
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 overflow-x-auto animate-slide-up animation-delay-200">

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/40">
                        <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Nama</th>
                        <th class="py-3 px-4 font-semibold text-gray-700 dark:text-gray-300 hidden md:table-cell">Email</th>
                        <th class="py-3 px-4 text-center font-semibold text-gray-700 dark:text-gray-300">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $gurus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guru): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 animate-fade-in-row">

                            
                            <td class="py-3 px-4 font-semibold text-gray-800 dark:text-gray-100">
                                <?php echo e($guru->name); ?>

                            </td>

                            
                            <td class="py-3 px-4 hidden md:table-cell text-gray-700 dark:text-gray-300">
                                <?php echo e($guru->email); ?>

                            </td>

                            
                            <td class="py-3 px-4 flex items-center justify-center gap-3">

                                <a href="<?php echo e(route('admin.guru.edit', $guru->id)); ?>"
                                   class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span class="hidden sm:inline">Edit</span>
                                </a>

                                <form method="POST" 
                                      action="<?php echo e(route('admin.guru.destroy', $guru->id)); ?>"
                                      onsubmit="return confirm('Yakin hapus guru ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span class="hidden sm:inline">Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center py-6 text-gray-600 dark:text-gray-400 animate-pulse">
                                Belum ada guru terdaftar.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <div class="mt-6 flex justify-center animate-fade-in">
            <?php echo e($gurus->links('pagination::tailwind')); ?>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/admin/guru/index.blade.php ENDPATH**/ ?>