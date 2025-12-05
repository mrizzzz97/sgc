

<?php $__env->startSection('content'); ?>
<div class="px-6 py-10 max-w-5xl mx-auto">

    <h1 class="text-2xl font-bold mb-6 dark:text-white">Modul Pembelajaran</h1>

    <style>
        .module-card {
            border-radius: 20px;
            padding: 22px;
            background: #ffffff;
            border: 1px solid rgba(0,0,0,0.05);
            transition: .25s ease;
            position: relative;
        }
        .dark .module-card {
            background: #1f2937;
            border-color: rgba(255,255,255,0.06);
        }

        .module-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 22px rgba(0,0,0,0.13);
        }
        .dark .module-card:hover {
            box-shadow: 0 12px 22px rgba(0,0,0,0.45);
        }

        .mod-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg,#6366f1,#8b5cf6);
            display:flex;
            align-items:center;
            justify-content:center;
            color:white;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .status-badge {
            position: absolute;
            top: 18px;
            right: 18px;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size: 15px;
            font-weight: bold;
        }
        .status-done {
            background: #10b98133;
            color: #10b981;
        }
        .status-not {
            background: #ef444433;
            color: #ef4444;
        }
    </style>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php
                // Ambil total chapter modul ini
                $totalCh = $m->chapters->count();

                // Hitung chapter yang selesai
                $doneCh = \App\Models\ChapterResult::where('user_id', auth()->id())
                            ->whereIn('chapter_id', $m->chapters->pluck('id'))
                            ->where('passed', true)
                            ->count();

                // Sudah selesai semua?
                $finished = ($totalCh > 0 && $doneCh == $totalCh);
            ?>

        <a href="<?php echo e(route('murid.modules.show', $m->id)); ?>" class="module-card block">

            
            <div class="status-badge <?php echo e($finished ? 'status-done' : 'status-not'); ?>">
                <?php echo e($finished ? '✔' : '✖'); ?>

            </div>

            <div class="mod-icon">
                <i class="fa-solid fa-book-open"></i>
            </div>

            <h2 class="text-lg font-semibold dark:text-white">
                <?php echo e($m->title); ?>

            </h2>

            <p class="text-gray-600 dark:text-gray-300 text-sm mt-2 line-clamp-2">
                <?php echo e($m->description); ?>

            </p>

            
            <div class="mt-4 w-full h-2 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                <div class="h-full rounded-full bg-indigo-500 transition-all"
                     style="width: <?php echo e($totalCh > 0 ? ($doneCh / $totalCh) * 100 : 0); ?>%">
                </div>
            </div>

        </a>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/dashboard/modul.blade.php ENDPATH**/ ?>