

<?php $__env->startSection('title', 'Hasil Modul'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-3xl mx-auto">

    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow">

        
        <h1 class="text-3xl font-bold dark:text-white mb-6">
            Hasil Modul: <?php echo e($module->title); ?>

        </h1>

        
        <div class="mb-6 p-4 rounded-xl bg-indigo-600 text-white">
            <p class="text-lg">
                Nilai Rata-rata Modul:
                <span class="font-bold text-2xl"><?php echo e(request()->avg ?? '0'); ?>%</span>
            </p>
        </div>

        
        <h2 class="text-xl font-semibold dark:text-white mb-4">Ringkasan Per Chapter</h2>

        <ul class="space-y-4 mb-8">
            <?php $__currentLoopData = $module->chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $result = \App\Models\ChapterResult::where('chapter_id', $chap->id)
                        ->where('user_id', auth()->id())
                        ->first();
                ?>

                <li class="p-4 bg-gray-700 rounded-xl text-white">
                    <div class="flex justify-between">
                        <span class="font-semibold"><?php echo e($chap->title); ?></span>

                        <span>
                            <?php if($result): ?>
                                <span class="font-bold"><?php echo e($result->score); ?>%</span>
                                —
                                <span class="<?php echo e($result->passed ? 'text-green-400' : 'text-red-400'); ?>">
                                    <?php echo e($result->passed ? 'Lulus' : 'Tidak Lulus'); ?>

                                </span>
                            <?php else: ?>
                                <span class="text-gray-300">Belum Dikerjakan</span>
                            <?php endif; ?>
                        </span>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        
        <?php
            $chapterIds = $module->chapters->pluck('id');
            $allPassed = \App\Models\ChapterResult::whereIn('chapter_id', $chapterIds)
                ->where('user_id', auth()->id())
                ->where('passed', true)
                ->count() == $module->chapters->count();
        ?>

        
        <?php if($allPassed): ?>
            <div class="mb-6 p-4 bg-green-600 text-white rounded-xl">
                Semua chapter telah diselesaikan dengan nilai minimal 75%.
                Anda berhak mendapatkan sertifikat penyelesaian modul.
            </div>

            <a href="<?php echo e(route('murid.modules.certificate', $module->id)); ?>"
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                Unduh Sertifikat (PDF)
            </a>
        <?php else: ?>
            <div class="mb-6 p-4 bg-red-600 text-white rounded-xl">
                Anda belum menyelesaikan seluruh chapter dengan nilai minimal 75%.
                Silakan ulangi chapter yang belum lulus.
            </div>
        <?php endif; ?>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/dashboard/modul_result.blade.php ENDPATH**/ ?>