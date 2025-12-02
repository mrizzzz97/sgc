

<?php $__env->startSection('title', $chapter->title . ' — Halaman ' . $page->page_number); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('error')): ?>
    <div class="mb-4 p-4 bg-red-600 text-white rounded-xl shadow">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<?php if(session('success')): ?>
    <div class="mb-4 p-4 bg-green-600 text-white rounded-xl shadow">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="max-w-4xl mx-auto">

    <!-- JUDUL -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-6">
        <h1 class="text-2xl font-bold dark:text-white">
            <?php echo e($chapter->title); ?> — Halaman <?php echo e($page->page_number); ?>

        </h1>
        <p class="text-gray-400 dark:text-gray-300 mt-1">
            Modul: <?php echo e($chapter->module->title); ?>

        </p>
    </div>

    <?php
    $totalPages = $pages->count();
    $currentPageNumber = $page->page_number;
    $percent = round(($currentPageNumber / $totalPages) * 100);
?>

    <div class="mb-6">
        <p class="text-sm text-gray-400 dark:text-gray-300">
            Halaman <?php echo e($currentPageNumber); ?> dari <?php echo e($totalPages); ?>

        </p>

        <div class="w-full h-2 bg-gray-700 rounded mt-1">
            <div class="h-2 bg-indigo-500 rounded"
                style="width: <?php echo e($percent); ?>%"></div>
        </div>
    </div>



    
    
    
    <?php if($page->type === 'video'): ?>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-6">
            <h2 class="font-semibold mb-3 dark:text-white">Video Pembelajaran</h2>

            <div class="aspect-video w-full rounded-xl overflow-hidden bg-black">
                <iframe 
                    src="<?php echo e(str_replace('watch?v=', 'embed/', $page->video_url)); ?>"
                    allowfullscreen
                    class="w-full h-full">
                </iframe>
            </div>
        </div>
    <?php endif; ?>


    
    
    
    <?php if($page->type === 'content'): ?>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-6">
            <h2 class="font-semibold mb-3 dark:text-white">Materi</h2>

            <div class="prose dark:prose-invert max-w-none text-white">
                <?php echo nl2br(e($page->content)); ?>

            </div>
        </div>
    <?php endif; ?>


    
    
    
    <?php if($page->type === 'question'): ?>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mb-6">
            
            <h2 class="font-semibold mb-3 dark:text-white">Pertanyaan</h2>

            <p class="dark:text-gray-200 mb-3">
                <?php echo e($page->question_text); ?>

            </p>

            <?php
                $options = is_array($page->options)
                    ? $page->options
                    : json_decode($page->options, true);
            ?>

            <form 
                action="<?php echo e(route('murid.modules.page.complete', ['chapter' => $chapter->id, 'page' => $page->page_number])); ?>" 
                method="POST"
                class="confirm-submit"
            >
                <?php echo csrf_field(); ?>

                <div class="mt-4 space-y-3">
                    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="flex items-center space-x-3 bg-gray-700 p-3 rounded-xl cursor-pointer">
                            <input type="radio" name="answer" value="<?php echo e($key); ?>" required>
                            <span class="text-white"><?php echo e(strtoupper($key)); ?>. <?php echo e($value); ?></span>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php if(session('error')): ?>
                    <p class="text-red-400 mt-4"><?php echo e(session('error')); ?></p>
                <?php endif; ?>

                
                <div class="flex justify-between mt-6">
                    
                    
                    <?php
                        $prevPage = $pages->where('page_number', $page->page_number - 1)->first();
                    ?>

                    <?php if($prevPage): ?>
                        <a href="<?php echo e(route('murid.modules.page', ['chapter' => $chapter->id, 'page' => $prevPage->page_number])); ?>"
                           class="px-4 py-2 bg-gray-500 text-white rounded-lg">
                            ← Sebelumnya
                        </a>
                    <?php else: ?>
                        <span></span>
                    <?php endif; ?>


                    
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                        Jawab & Lanjut →
                    </button>
                </div>

            </form>

        </div>
    <?php endif; ?>



    
    
    
    <?php if($page->type !== 'question'): ?>

        <?php
            $prevPage = $pages->where('page_number', $page->page_number - 1)->first();
        ?>

        <div class="flex justify-between mt-6">

            
            <?php if($prevPage): ?>
                <a href="<?php echo e(route('murid.modules.page', ['chapter' => $chapter->id, 'page' => $prevPage->page_number])); ?>"
                   class="px-4 py-2 bg-gray-500 text-white rounded-lg">
                    ← Sebelumnya
                </a>
            <?php else: ?>
                <span></span>
            <?php endif; ?>

            
            <form 
                action="<?php echo e(route('murid.modules.page.complete', ['chapter' => $chapter->id, 'page' => $page->page_number])); ?>"
                method="POST" 
                class="confirm-submit">
                <?php echo csrf_field(); ?>
                <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                    Lanjut →
                </button>
            </form>

        </div>
    <?php endif; ?>

</div>



<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.confirm-submit');

    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Konfirmasi Pengiriman',
                text: 'Apakah Anda yakin ingin melanjutkan?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, lanjut',
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