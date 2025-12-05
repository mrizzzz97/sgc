

<?php $__env->startSection('title', 'Dashboard Murid'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $modul_selesai = $modul_selesai ?? 0;
    $rank = $rank ?? '-';
    $xp_total = $xp_total ?? 0;
    $level = $level ?? 1;
    $xp_progress = $xp_progress ?? 0;
    $xp_for_next = $xp_for_next ?? ($level * 500);
?>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* ====== WRAPPER ====== */
.dashboard-container {
    max-width: 1150px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

/* ====== BASE CARD ====== */
.card {
    @apply bg-white dark:bg-gray-800;
    padding: 24px;
    border-radius: 22px;
    border: 1px solid rgba(0,0,0,0.05);
    transition: .25s ease;
}


.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 22px rgba(0,0,0,0.08);
}

/* ====== HEADER ====== */
.header-card {
    padding: 32px;
    border-radius: 22px;
    margin-bottom: 20px;
    box-shadow: 0 18px 30px rgba(0,0,0,0.12);
}

/* ====== STAT CARD ====== */
.stat-card {
    padding: 26px;
    text-align: center;
    border-radius: 22px;
    background: linear-gradient(135deg,#ffffff,#f8fafc);
    border: 1px solid rgba(0,0,0,0.05);
    transition: .25s;
}

.dark .stat-card {
    background: linear-gradient(135deg,#1f2937,#111827);
    border-color: rgba(255,255,255,0.05);
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.12);
}

/* ICON */
.icon-box {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
    margin-bottom:12px;
}

.icon-green {background:linear-gradient(135deg,#10b981,#059669);}
.icon-blue {background:linear-gradient(135deg,#3b82f6,#2563eb);}
.icon-orange {background:linear-gradient(135deg,#f59e0b,#d97706);}

/* ====== TITLES ====== */
.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--tw-gray-900);
}

.section-title::after {
    content:'';
    width:40px;height:3px;
    background:linear-gradient(90deg,#6366f1,#8b5cf6);
    border-radius:3px;
    display:block;
    margin-top:4px;
}

/* ====== PROGRESS BAR ====== */
.progress-wrap {
    width:100%;
    height:10px;
    border-radius:999px;
    background:#e5e7eb;
    overflow:hidden;
}

.dark .progress-wrap {background:#374151;}

.progress-val {
    height:100%;
    border-radius:999px;
    background:linear-gradient(90deg,#6366f1,#8b5cf6);
    transition: width 1s ease-out;
}

/* ====== MODULE ITEM ====== */
.mod-item {
    padding:18px;
    border-radius:18px;
    background:#f3f4f6;
    border:1px solid rgba(0,0,0,0.03);
    transition: .25s ease;
}

.dark .mod-item {
    background:#1f2937;
    border-color:rgba(255,255,255,0.04);
}

.mod-item:hover {
    background:white;
    box-shadow:0 4px 12px rgba(0,0,0,0.06);
}

.dark .mod-item:hover {
    background:#374151;
}

/* ====== PROFILE CARD ====== */
.profile-card {
    padding:28px;
    border-radius:22px;
}

.user-avatar {
    width:84px;
    height:84px;
    border-radius:50%;
    background:linear-gradient(135deg,#6366f1,#8b5cf6);
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:1.5rem;
    font-weight:700;
    margin:auto;
    transition: .25s;
}

.user-avatar:hover {
    transform:scale(1.07);
    box-shadow:0 12px 20px rgba(99,102,241,0.25);
}
</style>

<div class="dashboard-container space-y-6">

    <!-- HEADER -->
    <div data-aos="fade-down"
        class="card header-card bg-gradient-to-r from-indigo-500 to-purple-600 text-white border-0">

        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold">Dashboard Belajar</h1>
                <p class="text-sm text-white/80">Progress kamu hari ini.</p>
            </div>

            <div class="rounded-xl bg-white/10 backdrop-blur-md px-4 py-2 text-center">
                <p class="text-xs text-white/70">Member</p>
                <p class="text-lg font-semibold"><?php echo e($user->name); ?></p>
                <p class="text-xs text-white/60"><?php echo e($user->created_at->format('M Y')); ?></p>
            </div>
        </div>
    </div>

    <!-- TOP STATS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        
        <div data-aos="fade-up" class="stat-card">
            <div class="icon-box icon-green">
                <i class="fa-solid fa-check text-white text-xl"></i>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Selesai</p>
            <p class="text-2xl font-bold"><?php echo e($modul_selesai); ?></p>
        </div>

        <div data-aos="fade-up" data-aos-delay="150" class="stat-card">
            <div class="icon-box icon-blue">
                <i class="fas fa-ranking-star text-white text-xl"></i>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Rank</p>
            <p class="text-2xl font-bold text-blue-500">Top <?php echo e($rank); ?></p>
        </div>

        <div data-aos="fade-up" data-aos-delay="300" class="stat-card">
            <div class="icon-box icon-orange">
                <i class="fas fa-fire text-white text-xl"></i>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400">XP</p>
            <p class="text-2xl font-bold"><?php echo e($xp_total); ?></p>
        </div>

    </div>

    <!-- LEVEL & XP -->
    <div class="card" data-aos="fade-up" data-aos-delay="400">
        <h3 class="section-title">Level & XP</h3>

        <p class="text-sm text-gray-600 dark:text-gray-400">Lv <?php echo e($level); ?> • <?php echo e($xp_total); ?> XP</p>

        <div class="progress-wrap my-3">
            <div class="progress-val" style="width: <?php echo e($xp_progress); ?>%"></div>
        </div>

        <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400">
            <span><?php echo e($xp_total); ?> XP</span>
            <span><?php echo e($xp_progress); ?>%</span>
            <span><?php echo e($xp_for_next); ?> XP</span>
        </div>
    </div>

    <!-- MAIN TWO COLUMNS -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- MODULE LIST -->
        <div class="lg:col-span-2 space-y-4">
            <div class="card module-card" data-aos="fade-right" data-aos-delay="500">
                <div class="flex justify-between mb-4">
                    <h3 class="section-title">Modul Kamu</h3>
                    <a href="<?php echo e(route('murid.modul')); ?>"
                       class="text-sm text-indigo-500 hover:underline">Lihat semua →</a>
                </div>

                <div class="space-y-3">
                    <?php $__empty_1 = true; $__currentLoopData = $modules_progress; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="mod-item">
                            <div class="flex justify-between">
                                <p class="font-semibold"><?php echo e($m['title']); ?></p>
                                <p class="font-semibold text-indigo-500"><?php echo e($m['percent']); ?>%</p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                                <?php echo e($m['completed']); ?> / <?php echo e($m['total_chapters']); ?>

                            </p>
                            <div class="progress-wrap h-2">
                                <div class="progress-val" style="width: <?php echo e($m['percent']); ?>%"></div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center py-6">
                            <i class="fas fa-book text-3xl text-gray-300 dark:text-gray-600"></i>
                            <p class="text-sm mt-2 text-gray-500 dark:text-gray-400">
                                Belum ada modul aktif.
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- PROFILE CARD -->
        <div class="card profile-card text-center" data-aos="fade-left" data-aos-delay="550">

            <div class="user-avatar">
                <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

            </div>

            <h4 class="mt-4 font-semibold text-lg"><?php echo e($user->name); ?></h4>
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Murid • <?php echo e($user->created_at->format('M Y')); ?>

            </p>

            <div class="mt-4 bg-gray-50 dark:bg-gray-700 p-4 rounded-xl">
                <p class="text-xs text-gray-500 dark:text-gray-300 mb-2">Progress</p>

                <div class="progress-wrap h-2 mb-2">
                    <div class="progress-val" style="width: <?php echo e($xp_progress); ?>%"></div>
                </div>

                <div class="flex justify-between text-xs text-gray-600 dark:text-gray-300">
                    <span>Lv <?php echo e($level); ?></span>
                    <span><?php echo e($xp_total); ?> XP</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 mt-4">
                <div class="bg-gray-50 dark:bg-gray-700 py-3 rounded-lg">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Done</p>
                    <p class="font-semibold"><?php echo e($modul_selesai); ?></p>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 py-3 rounded-lg">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Rank</p>
                    <p class="font-semibold text-blue-500"><?php echo e($rank); ?></p>
                </div>
            </div>

        </div>
    </div>

</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ duration:700, once:true });

document.querySelectorAll(".progress-val").forEach((bar, i) => {
    let w = bar.style.width;
    bar.style.width = "0%";
    setTimeout(() => bar.style.width = w, 300 + i * 100);
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/dashboard/murid.blade.php ENDPATH**/ ?>