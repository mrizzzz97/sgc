    

    <?php $__env->startSection('title', 'Detail Modul'); ?>

    <?php $__env->startSection('leaderboard_button'); ?>
    <a href="<?php echo e(route('murid.modules.leaderboard', $module->id)); ?>"
    class="flex items-center gap-3 px-4 py-3 rounded-xl text-yellow-500 font-semibold hover:bg-yellow-100 dark:hover:bg-gray-700">
        <i class="fas fa-trophy w-5"></i> Leaderboard
    </a>
    <?php $__env->stopSection(); ?>


    <?php $__env->startSection('content'); ?>
    <div class="max-w-4xl mx-auto">

        
        <h1 class="text-2xl font-bold mb-6 dark:text-white">
            <?php echo e($module->title); ?>

        </h1>

        <p class="text-gray-600 dark:text-gray-300 mb-6">
            <?php echo e($module->description); ?>

        </p>

        
        <h2 class="text-xl font-semibold mb-4 dark:text-white">
            Daftar Chapter
        </h2>

        <div class="space-y-3">
            <?php $__empty_1 = true; $__currentLoopData = $module->chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <?php
                    // Ambil chapter sebelumnya
                    $prev = $module->chapters
                        ->where('order', '<', $c->order)
                        ->sortByDesc('order')
                        ->first();

                    $canOpen = true;

                    if ($prev) {
                        $canOpen = \App\Models\ChapterResult::where('chapter_id', $prev->id)
                            ->where('user_id', auth()->id())
                            ->where('passed', true)
                            ->exists();
                    }

                    $result = \App\Models\ChapterResult::where('chapter_id', $c->id)
                        ->where('user_id', auth()->id())
                        ->first();
                ?>

                <a href="<?php echo e($canOpen ? route('murid.modules.chapter', $c->id) : '#'); ?>"
                class="flex justify-between items-center p-4 rounded-lg shadow 
                        <?php echo e($canOpen 
                                ? 'bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700' 
                                : 'bg-gray-300 dark:bg-gray-700 opacity-50 cursor-not-allowed'); ?>">

                    <div>
                        <p class="font-semibold dark:text-white"><?php echo e($c->title); ?></p>
                        <p class="text-sm text-gray-500 dark:text-gray-300"><?php echo e($c->description); ?></p>
                    </div>

                    
                    <?php if($result && $result->passed): ?>
                        <span class="text-green-500 font-bold text-xl">✔</span>
                    <?php else: ?>
                        <span class="text-gray-400 font-bold text-xl">✖</span>
                    <?php endif; ?>

                </a>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-gray-500 dark:text-gray-300">Belum ada chapter.</p>
            <?php endif; ?>
        </div>


        
        <div class="bg-gray-800 p-6 rounded-xl mt-10">
            <h3 class="text-xl font-semibold mb-4 text-white">Tambahkan Komentar</h3>

            <form action="<?php echo e(route('modules.comment', $module->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <textarea name="comment"
                    class="w-full p-3 rounded-lg bg-gray-700 text-white"
                    rows="3"
                    placeholder="Tulis komentar..."></textarea>

                <button class="mt-3 px-4 py-2 bg-indigo-600 rounded-lg text-white hover:bg-indigo-700">
                    Kirim Komentar
                </button>
            </form>
        </div>


        
        <div class="bg-gray-800 p-6 rounded-xl mt-10">
            <h3 class="text-xl font-semibold mb-6 text-white">Komentar</h3>

            
            <div class="space-y-6">
                <?php $__currentLoopData = $module->comments->where('parent_id', null)->sortBy('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('components.comment-bubble', [
                        'comment' => $comment,
                        'module' => $module
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

    </div>

    

    
    <script>
        function openReplyForm(id) {
            document.getElementById('reply-form-' + id).classList.toggle('hidden');
        }

        function toggleReplies(id) {
            const wrapper = document.getElementById('reply-wrapper-' + id);
            const text = document.getElementById('toggle-reply-text-' + id);
            const count = text.textContent.match(/\((\d+)\)/)[1]; // ambil angka dalam ()

            if (wrapper.classList.contains('hidden')) {
                wrapper.classList.remove('hidden');
                text.textContent = `Sembunyikan balasan (${count})`;
            } else {
                wrapper.classList.add('hidden');
                text.textContent = `Tampilkan balasan (${count})`;
            }
        }
    </script>

    

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/dashboard/modul_show.blade.php ENDPATH**/ ?>