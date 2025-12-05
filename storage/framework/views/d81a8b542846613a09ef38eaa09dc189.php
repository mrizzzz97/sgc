

<?php $__env->startSection('title', 'Halaman Chapter'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 transition-colors duration-300">
    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">

        <!-- HEADER -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div class="flex items-center gap-4">
                        <div class="bg-white/20 backdrop-blur-sm rounded-full p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 class="h-7 w-7 sm:h-8 sm:w-8 text-white" 
                                 fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 
                                      3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 
                                      4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 
                                      3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 
                                      16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>

                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-white">Halaman Chapter</h1>
                            <p class="text-indigo-100 text-sm sm:text-base"><?php echo e($chapter->title); ?></p>
                        </div>
                    </div>

                    <a href="<?php echo e(route('guru.modul.chapter.pages.create', $chapter->id)); ?>"
                       class="inline-flex items-center justify-center px-4 py-2 bg-white text-indigo-600 
                              rounded-lg font-medium shadow-md hover:shadow-lg hover:scale-105 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Halaman
                    </a>
                </div>
            </div>
        </div>

        <!-- LIST HALAMAN -->
        <div class="space-y-4">
            <?php $__empty_1 = true; $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl transition-all 
                            duration-300 transform hover:scale-[1.02] overflow-hidden">
                    <div class="p-6">

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                            <!-- LEFT: ICON + INFO -->
                            <div class="flex items-start sm:items-center gap-4 flex-1">

                                <!-- ICON FIXED (ALWAYS WHITE, NO BLACK DOT) -->
                                <div class="flex-shrink-0 bg-gradient-to-br 
                                    <?php echo e($p->type === 'video' ? 'from-red-400 to-pink-500' : 'from-blue-400 to-indigo-500'); ?>

                                    rounded-xl p-3 shadow-md">

                                    <?php if($p->type === 'video'): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" 
                                             class="h-6 w-6 text-white"
                                             viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 
                                                  01-1.447.894L15 14M15 10v4m0-4L9 6m6 4l-6 4M9 6a2 2 0 
                                                  00-2 2v8a2 2 0 002 2l6-4" />
                                        </svg>
                                    <?php else: ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" 
                                             class="h-6 w-6 text-white"
                                             viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M4 6h16M4 12h16M4 18h10" />
                                        </svg>
                                    <?php endif; ?>

                                </div>

                                <!-- TEXT INFO -->
                                <div class="min-w-0">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        Halaman <?php echo e($p->page_number); ?>

                                    </h3>

                                    <div class="flex flex-wrap items-center gap-2 mt-1 text-xs">

                                        <!-- BADGE -->
                                        <span class="px-2.5 py-0.5 rounded-full font-medium 
                                            <?php echo e($p->type === 'video'
                                                ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
                                                : 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200'); ?>">
                                            <?php echo e(ucfirst($p->type)); ?>

                                        </span>

                                        <!-- PREVIEW TEXT -->
                                        <?php if($p->type === 'video' && $p->video_url): ?>
                                            <span class="text-gray-500 dark:text-gray-400 truncate 
                                                         max-w-[150px] sm:max-w-xs">
                                                <?php echo e($p->video_url); ?>

                                            </span>
                                        <?php elseif($p->type === 'question'): ?>
                                            <span class="text-gray-500 dark:text-gray-400 truncate 
                                                         max-w-[150px] sm:max-w-xs">
                                                <?php echo e(Str::limit($p->question_text, 50)); ?>

                                            </span>
                                        <?php endif; ?>

                                    </div>
                                </div>

                            </div>

                            <!-- ACTION BUTTONS -->
                            <div class="flex flex-wrap sm:flex-nowrap gap-3 w-full sm:w-auto">

                                <!-- EDIT -->
                                <a href="<?php echo e(route('guru.modul.chapter.pages.edit', [$chapter->id, $p->id])); ?>"
                                   class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2
                                          bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 
                                          rounded-lg font-medium hover:bg-gray-200 dark:hover:bg-gray-600
                                          shadow-sm hover:scale-105 transition">

                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                         class="h-4 w-4 mr-2" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 
                                              002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 
                                              0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>

                                <!-- DELETE -->
                                <form action="<?php echo e(route('guru.modul.chapter.pages.delete', [$chapter->id, $p->id])); ?>"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus halaman ini?')"
                                      class="flex-1 sm:flex-none">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button type="submit"
                                            class="w-full inline-flex items-center justify-center px-4 py-2
                                                   bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400
                                                   rounded-lg font-medium hover:bg-red-100 dark:hover:bg-red-900/50
                                                   shadow-sm hover:scale-105 transition">

                                        <svg xmlns="http://www.w3.org/2000/svg" 
                                             class="h-4 w-4 mr-2" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 
                                                  21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4
                                                  a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>

                                        Hapus
                                    </button>
                                </form>

                            </div>

                        </div>

                    </div>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <!-- EMPTY STATE -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-12 text-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        Belum ada halaman
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">
                        Tambahkan halaman pertama untuk chapter ini.
                    </p>

                    <a href="<?php echo e(route('guru.modul.chapter.pages.create', $chapter->id)); ?>"
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white 
                              rounded-lg font-medium shadow-md hover:shadow-lg hover:scale-105 transition">
                        Tambah Halaman Pertama
                    </a>
                </div>

            <?php endif; ?>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guru', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/guru/chapters/pages/index.blade.php ENDPATH**/ ?>