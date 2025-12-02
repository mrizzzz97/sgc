

<?php $__env->startSection('title', 'Dashboard Murid'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $modul_selesai = $modul_selesai ?? 0;
    $rank = $rank ?? '-';
    $xp_total = $xp_total ?? 0;
    $level = $level ?? 1;
    $xp_progress = $xp_progress ?? 0;
?>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold dark:text-white">Progress Belajar Kamu 🎓</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Lihat perkembangan belajar kamu.</p>
                </div>

                <div class="text-right">
                    <p class="text-sm text-gray-500">Member</p>
                    <p class="font-semibold dark:text-white"><?php echo e($user->name); ?></p>
                    <p class="text-xs text-gray-400">Joined <?php echo e($user->created_at->format('M Y')); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Stats -->
    <div class="grid lg:grid-cols-3 gap-6 mb-6">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
            <p class="text-sm text-gray-500">Modul Selesai</p>
            <p class="text-3xl font-extrabold text-indigo-600 mt-3"><?php echo e($modul_selesai); ?></p>
        </div>

        <!-- Tugas Pending DIHAPUS -->

        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
            <p class="text-sm text-gray-500">Rank Kelas</p>
            <p class="text-3xl font-extrabold text-green-400 mt-3">Top <?php echo e($rank); ?></p>
        </div>
    </div>

    <!-- XP -->
    <div data-aos="fade-up" class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold dark:text-white">Level & XP</h3>
                <p class="text-sm text-gray-500 dark:text-gray-300">Level <?php echo e($level); ?> — <?php echo e($xp_total); ?> XP</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Next: <?php echo e($xp_for_next ?? ($level * 100)); ?> XP</p>
            </div>
        </div>

        <div class="mt-4">
            <div class="w-full bg-gray-200 dark:bg-gray-700 h-3 rounded-full overflow-hidden">
                <div class="h-3 bg-indigo-500" style="width: <?php echo e($xp_progress); ?>%"></div>
            </div>
            <p class="text-xs text-gray-500 mt-2">
                <?php echo e($xp_total); ?> / <?php echo e($xp_for_next ?? ($level * 100)); ?> XP (<?php echo e($xp_progress); ?>%)
            </p>
        </div>
    </div>

    <!-- Modul yang sedang dikerjakan -->
    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold dark:text-white">Modul yang sedang kamu kerjakan</h3>
                    <a href="<?php echo e(route('murid.modul')); ?>" class="text-sm text-indigo-600">Lihat semua</a>
                </div>

                <div class="space-y-3">
                    <?php $__empty_1 = true; $__currentLoopData = $modules_progress; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-semibold dark:text-white"><?php echo e($m['title']); ?></p>
                                    <p class="text-xs text-gray-500 dark:text-gray-300">
                                        <?php echo e($m['completed']); ?> / <?php echo e($m['total_chapters']); ?> chapter
                                    </p>
                                </div>
                                <div class="text-sm text-gray-500"><?php echo e($m['percent']); ?>%</div>
                            </div>

                            <div class="w-full mt-3 h-2 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden">
                                <div class="h-full bg-indigo-500" style="width: <?php echo e($m['percent']); ?>%"></div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-sm text-gray-500">Belum ada modul yang aktif.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- Profile -->
        <aside class="space-y-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow text-center">
                <div class="w-20 h-20 mx-auto rounded-full bg-indigo-600 text-white text-2xl font-bold flex items-center justify-center">
                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                </div>

                <h4 class="mt-4 font-semibold dark:text-white"><?php echo e($user->name); ?></h4>
                <p class="text-xs text-gray-400">Murid • Joined <?php echo e($user->created_at->format('M Y')); ?></p>

                <div class="mt-4 text-left">
                    <p class="text-xs text-gray-400">Progress level</p>
                    <div class="w-full h-3 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden mt-2">
                        <div class="h-full bg-gradient-to-r from-indigo-500 to-pink-500" style="width: <?php echo e($xp_progress); ?>%"></div>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Level <?php echo e($level); ?> • <?php echo e($xp_total); ?> XP</p>
                </div>
            </div>

        </aside>
    </div>
</div>

<script>
    (function() {
        const percent = <?php echo e(isset($modules_progress) && count($modules_progress)
            ? json_encode((int) round(array_sum(array_column($modules_progress, 'percent')) / max(1, count($modules_progress))))
            : 0); ?>;
        if (window.setSidebarProgress) window.setSidebarProgress(percent);
    })();
</script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init()</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/dashboard/murid.blade.php ENDPATH**/ ?>