

<?php $__env->startSection('title', 'Edit Modul'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 transition-colors duration-300">
    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">

        <!-- HEADER -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-8 transform transition-all duration-500 hover:shadow-2xl">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
                <div class="flex items-center">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-white">Edit Modul</h1>
                        <p class="text-indigo-100 mt-1"><?php echo e($module->title); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500 hover:shadow-2xl">
            <form action="<?php echo e(route('guru.modul.update', $module->id)); ?>" method="POST" class="p-6 md:p-8">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>

                <!-- TITLE -->
                <div class="mb-6 group">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-focus-within:text-indigo-500">
                        Judul Modul
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.6a1 1 0 01.7.3l5.4 5.4a1 1 0 01.3.7V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <input type="text" name="title" required
                               value="<?php echo e($module->title); ?>"
                               class="w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 dark:border-gray-600 
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white 
                                      focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 
                                      transform focus:scale-[1.02]">
                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div class="mb-6 group">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-focus-within:text-indigo-500">
                        Deskripsi Modul
                    </label>

                    <div class="relative">
                        <div class="absolute top-3 left-0 pl-3 pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </div>

                        <textarea name="description" rows="4" required
                                  class="w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 dark:border-gray-600 
                                         bg-white dark:bg-gray-700 text-gray-900 dark:text-white 
                                         focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 
                                         transform focus:scale-[1.02]"><?php echo e($module->description); ?></textarea>
                    </div>
                </div>


                <!-- ORDER -->
                <div class="mb-8 group">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-focus-within:text-indigo-500">
                        Urutan Modul
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                            </svg>
                        </div>

                        <input type="number" name="order" required min="1"
                               value="<?php echo e($module->order); ?>"
                               class="w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 dark:border-gray-600 
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white 
                                      focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 
                                      transform focus:scale-[1.02]">
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 
                               text-white rounded-lg font-medium shadow-lg hover:shadow-xl 
                               hover:scale-105 transition-all duration-200 flex items-center gap-2">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const groups = document.querySelectorAll(".group");
        groups.forEach((el, i) => {
            el.style.opacity = "0";
            el.style.transform = "translateY(20px)";
            setTimeout(() => {
                el.style.transition = "0.4s";
                el.style.opacity = "1";
                el.style.transform = "translateY(0)";
            }, 100 * i);
        });
    });
</script>

<style>
    button { position: relative; overflow: hidden; }
    .ripple {
        position: absolute;
        border-radius: 50%;
        transform: scale(0);
        background: rgba(255,255,255,.5);
        animation: ripple .6s ease-out;
    }
    @keyframes ripple {
        to { transform: scale(4); opacity: 0; }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guru', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/guru/modul/edit.blade.php ENDPATH**/ ?>