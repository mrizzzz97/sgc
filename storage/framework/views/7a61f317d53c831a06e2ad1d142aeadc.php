

<?php $__env->startSection('title', 'Notifikasi'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-4xl mx-auto mt-10 animate-fade-in">

    
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold bg-gradient-to-r from-indigo-500 to-purple-500 text-transparent bg-clip-text">
            Notifikasi Modul
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">
            Semua aktivitas dan pemberitahuan terbaru akan muncul di sini.
        </p>
    </div>

    
    <?php if($notifs->count() > 0): ?>
    <div class="flex justify-end mb-5">
        <form action="<?php echo e(route('guru.notif.clear')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button 
                class="px-4 py-2 text-sm font-semibold text-white rounded-lg 
                       bg-red-600 hover:bg-red-700 shadow-md hover:shadow-lg
                       transition-all duration-200">
                Hapus Semua Notifikasi
            </button>
        </form>
    </div>
    <?php endif; ?>

    
    <div class="space-y-4">

        <?php $__empty_1 = true; $__currentLoopData = $notifs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <div 
            class="
                p-5 rounded-xl shadow-md border transition-all duration-200 hover:-translate-y-1 
                <?php echo e($n->read 
                    ? 'bg-gray-100 dark:bg-gray-800 border-gray-300 dark:border-gray-700' 
                    : 'bg-indigo-600 border-indigo-700 text-white shadow-lg hover:shadow-2xl'); ?>

            ">

            <div class="flex justify-between items-start">

                
                <div class="max-w-[75%]">
                    <p class="font-semibold text-lg 
                        <?php echo e($n->read ? 'text-gray-900 dark:text-gray-100' : 'text-white'); ?>">
                        <?php echo e($n->message); ?>

                    </p>

                    <p class="text-xs mt-2 
                        <?php echo e($n->read ? 'text-gray-500 dark:text-gray-400' : 'text-indigo-200'); ?>">
                        <?php echo e($n->created_at->diffForHumans()); ?>

                    </p>
                </div>

                
                <?php if(!$n->read): ?>
                <form action="<?php echo e(route('guru.notif.read', $n->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button 
                        class="px-3 py-1.5 rounded-lg text-xs font-semibold 
                               bg-white text-indigo-600 hover:bg-gray-100
                               shadow hover:shadow-md transition-all duration-200">
                        Tandai Dibaca
                    </button>
                </form>
                <?php endif; ?>

            </div>

        </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        
        <div class="text-center py-20">
            <div 
                class="w-16 h-16 mx-auto rounded-full bg-gray-200 dark:bg-gray-700 
                       flex items-center justify-center mb-4">
                <i class="fas fa-bell-slash text-gray-500 dark:text-gray-300 text-2xl"></i>
            </div>
            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">
                Belum ada notifikasi.
            </p>
        </div>

        <?php endif; ?>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guru', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/guru/notif/index.blade.php ENDPATH**/ ?>