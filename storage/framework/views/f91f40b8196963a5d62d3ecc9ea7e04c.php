

<?php $__env->startSection('title', 'Daftar Chapter'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-5xl mx-auto p-4 sm:p-8 md:p-10 animate-fade-in">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10">
        <div>
            <h1 class="text-3xl md:text-4xl font-extrabold bg-gradient-to-r from-indigo-500 to-purple-500 
                       text-transparent bg-clip-text">
                Chapter Modul: <?php echo e($module->title); ?>

            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1 text-sm md:text-base">
                Kelola chapter dan susunan materi modul.
            </p>
        </div>

        <a href="<?php echo e(route('guru.modul.chapter.create', $module->id)); ?>"
           class="px-5 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 hover:opacity-90 
                  text-white rounded-xl font-semibold shadow-lg hover:shadow-2xl text-center
                  transition-all duration-300 text-sm sm:text-base">
            + Tambah Chapter
        </a>
    </div>

    <!-- LIST CHAPTER -->
    <div class="bg-white dark:bg-gray-800 p-5 sm:p-7 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">

        <?php if($module->chapters->isEmpty()): ?>

            <p class="py-14 text-center text-gray-500 dark:text-gray-300 text-lg">
                Belum ada chapter untuk modul ini.
            </p>

        <?php else: ?>

            <div class="space-y-6">

                <?php $__currentLoopData = $module->chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-5 sm:p-6 rounded-2xl border border-gray-200 dark:border-gray-700 
                                bg-gray-50 dark:bg-gray-900/40 shadow-md hover:shadow-xl 
                                transition-all duration-300 transform hover:-translate-y-1">

                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4">

                            <!-- INFO -->
                            <div class="flex items-start gap-4">

                                <!-- ICON -->
                                <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-xl 
                                            bg-indigo-100 dark:bg-indigo-900/40 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                         class="h-6 w-6 sm:h-7 sm:w-7 text-indigo-600 dark:text-indigo-300"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 6h16M4 12h16M4 18h7" />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-lg sm:text-xl font-bold dark:text-white leading-tight">
                                        <?php echo e($c->order); ?>. <?php echo e($c->title); ?>

                                    </h2>

                                    <p class="text-gray-600 dark:text-gray-400 text-sm mt-1 leading-relaxed">
                                        <?php echo e(Str::limit(strip_tags($c->description), 100)); ?>

                                    </p>
                                </div>
                            </div>

                            <!-- ACTION BUTTONS -->
                            <div class="flex flex-wrap gap-3 mt-2 sm:mt-0">

                                <!-- Edit -->
                                <a href="<?php echo e(route('guru.modul.chapter.edit', $c->id)); ?>"
                                   class="flex items-center gap-2 px-4 py-2 bg-gray-600 hover:bg-gray-700
                                          text-white rounded-lg text-sm shadow transition w-full sm:w-auto justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 
                                              2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>

                                <!-- Kelola Halaman -->
                                <a href="<?php echo e(route('guru.modul.chapter.pages.index', $c->id)); ?>"
                                   class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 
                                          text-white rounded-lg text-sm shadow transition w-full sm:w-auto justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M7 8h10M7 12h5m-5 4h8m5-9v12a2 2 0 01-2 2H7a2 2 0 
                                              01-2-2V6a2 2 0 012-2h8l4 4z" />
                                    </svg>
                                    Halaman
                                </a>

                                <!-- Delete -->
                                <form action="<?php echo e(route('guru.modul.chapter.delete', $c->id)); ?>"
                                      method="POST"
                                      class="w-full sm:w-auto"
                                      onsubmit="return confirm('Hapus chapter ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button
                                        class="flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 
                                               text-white rounded-lg text-sm shadow transition w-full sm:w-auto justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 
                                                  01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0a2 2 0 
                                                  012-2h4a2 2 0 012 2" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>

                            </div>

                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        <?php endif; ?>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guru', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/guru/chapters/index.blade.php ENDPATH**/ ?>