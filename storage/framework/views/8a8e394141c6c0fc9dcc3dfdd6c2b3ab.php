

<?php $__env->startSection('title', $chapter->title . ' — Halaman ' . $page->page_number); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('error')): ?>
    <div class="mb-4 p-4 bg-red-600/90 text-white rounded-xl shadow">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<?php if(session('success')): ?>
    <div class="mb-4 p-4 bg-green-600/90 text-white rounded-xl shadow">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php
    $totalPages  = $pages->count();
    $current     = $page->page_number;
    $percent     = $totalPages > 0 ? round(($current / $totalPages) * 100) : 0;

    // Halaman sebelumnya (1 langkah)
    $previous = $pages->where('page_number', $current - 1)->first();
?>

<div class="max-w-4xl mx-auto px-4 py-6">

    
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                p-6 rounded-2xl shadow-sm mb-6">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold dark:text-white"><?php echo e($chapter->title); ?></h1>
                <p class="text-sm text-gray-500 dark:text-gray-300">Modul: <?php echo e($chapter->module->title); ?></p>
            </div>

            <div class="text-right">
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Halaman <?php echo e($current); ?> dari <?php echo e($totalPages); ?>

                </p>
                <p class="text-xs text-indigo-600 font-semibold">
                    <?php echo e($percent); ?>% selesai
                </p>
            </div>
        </div>

        <div class="mt-4">
            <div class="w-full h-2.5 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-600"
                     style="width: <?php echo e($percent); ?>%"></div>
            </div>
        </div>
    </div>

    
    <?php if($page->type === 'video'): ?>
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                    p-6 rounded-2xl shadow mb-6">

            <h2 class="font-semibold mb-3 dark:text-white">Video Pembelajaran</h2>

            <div class="aspect-video rounded-xl overflow-hidden bg-black">
                <iframe src="<?php echo e(str_replace('watch?v=', 'embed/', $page->video_url)); ?>"
                        allowfullscreen class="w-full h-full"></iframe>
            </div>
        </div>
    <?php endif; ?>

    
    <?php if($page->type === 'content'): ?>
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                    p-6 rounded-2xl shadow mb-6">

            <h2 class="font-semibold mb-3 dark:text-white">Materi</h2>

            <div class="prose dark:prose-invert max-w-none">
                <?php echo nl2br(e($page->content)); ?>

            </div>
        </div>
    <?php endif; ?>

    
    <?php if($page->type === 'question'): ?>

        <?php
            $saved = \App\Models\ChapterPageProgress::where('user_id', auth()->id())
                        ->where('chapter_id', $chapter->id)
                        ->where('page_id', $page->id)
                        ->first();

            $savedAnswer = $saved->answer ?? null;
            $options     = is_array($page->options) ? $page->options : json_decode($page->options, true);
        ?>

        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                    p-6 rounded-2xl shadow mb-6">

            <h2 class="font-semibold mb-3 dark:text-white">Pertanyaan</h2>

            <p class="text-gray-900 dark:text-gray-100 mb-4">
                <?php echo e($page->question_text); ?>

            </p>

            <form 
                action="<?php echo e(route('murid.modules.page.complete', ['chapter' => $chapter->id, 'page' => $current])); ?>"
                method="POST"
                class="confirm-submit"
                data-is-last="<?php echo e($current == $totalPages ? '1' : '0'); ?>"
            >
                <?php echo csrf_field(); ?>

                
                <div class="space-y-3">
                    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="flex items-center gap-3 px-4 py-3 rounded-xl cursor-pointer
                                      bg-gray-100 hover:bg-gray-200
                                      dark:bg-gray-700 dark:hover:bg-gray-600 transition">
                            <input type="radio"
                                   name="answer"
                                   class="answer-radio accent-indigo-600"
                                   value="<?php echo e($key); ?>"
                                   <?php echo e($savedAnswer == $key ? 'checked' : ''); ?>>
                            <span class="text-gray-900 dark:text-gray-100">
                                <strong><?php echo e(strtoupper($key)); ?>.</strong> <?php echo e($value); ?>

                            </span>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div class="mt-6 bg-gray-50 dark:bg-gray-900/60 border border-gray-200 dark:border-gray-700
                            rounded-2xl px-4 py-3 flex justify-between">

                    
                    <?php if($previous): ?>
                        <a href="<?php echo e(route('murid.modules.page', ['chapter' => $chapter->id, 'page' => $previous->page_number])); ?>"
                           class="px-4 py-2 rounded-xl bg-gray-200 dark:bg-gray-700 text-sm text-gray-900 dark:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            <i class="fas fa-arrow-left text-xs"></i> Sebelumnya
                        </a>
                    <?php else: ?>
                        <span></span>
                    <?php endif; ?>

                    
                    <button type="submit"
                            class="px-4 py-2 rounded-xl bg-indigo-600 text-white text-sm hover:bg-indigo-700 transition">
                        Jawab & Lanjut
                        <i class="fas fa-arrow-right text-xs"></i>
                    </button>

                </div>
            </form>

        </div>

    <?php endif; ?>

    
    <?php if($page->type !== 'question'): ?>

        <div class="mt-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                    px-4 py-3 rounded-2xl shadow-sm flex justify-between">

            
            <?php if($previous): ?>
                <a href="<?php echo e(route('murid.modules.page', ['chapter' => $chapter->id, 'page' => $previous->page_number])); ?>"
                   class="px-4 py-2 rounded-xl bg-gray-200 dark:bg-gray-700 text-sm text-gray-900 dark:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    <i class="fas fa-arrow-left text-xs"></i> Sebelumnya
                </a>
            <?php else: ?>
                <span></span>
            <?php endif; ?>

            
            <form 
                action="<?php echo e(route('murid.modules.page.complete', ['chapter' => $chapter->id, 'page' => $current])); ?>"
                method="POST"
                class="confirm-submit"
                data-is-last="<?php echo e($current == $totalPages ? '1' : '0'); ?>">
                <?php echo csrf_field(); ?>

                <button type="submit"
                        class="px-4 py-2 rounded-xl bg-indigo-600 text-white text-sm hover:bg-indigo-700 transition">
                    Lanjut <i class="fas fa-arrow-right text-xs"></i>
                </button>
            </form>

        </div>

    <?php endif; ?>

</div>

<?php $__env->startPush('scripts'); ?>
<script>
    // ============ AUTOSAVE ============
    document.querySelectorAll('.answer-radio').forEach(radio => {
        radio.addEventListener('change', function () {
            fetch("<?php echo e(route('murid.modules.page.autosave')); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                },
                body: JSON.stringify({
                    chapter_id: <?php echo e($chapter->id); ?>,
                    page_id: <?php echo e($page->id); ?>,
                    answer: this.value
                })
            });
        });
    });

    // ============ KONFIRMASI HANYA DI HALAMAN TERAKHIR ============
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.confirm-submit');

        forms.forEach(form => {
            form.addEventListener('submit', function (e) {
                const isLast = form.dataset.isLast === '1';

                // Jika bukan halaman terakhir → langsung submit tanpa notifikasi
                if (!isLast) {
                    return; // biarkan form submit normal
                }

                // Jika halaman terakhir → tampilkan konfirmasi
                e.preventDefault();

                Swal.fire({
                    title: 'Selesaikan chapter?',
                    text: 'Ini adalah halaman terakhir. Menandai selesai akan mengakhiri chapter ini. Apakah Anda yakin ingin melanjutkan?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, selesai',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/dashboard/page.blade.php ENDPATH**/ ?>