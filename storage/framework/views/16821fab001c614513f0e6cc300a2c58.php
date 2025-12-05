

<?php $__env->startSection('title', 'Komentar Modul'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br 
            from-gray-50 to-gray-200 
            dark:from-gray-900 dark:to-gray-800 
            transition-all duration-300">

    <div class="max-w-4xl mx-auto p-6 md:p-10">

        <!-- HEADER -->
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden mb-10
                    transition-all duration-300 hover:shadow-2xl">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
                <h1 class="text-3xl font-bold text-white drop-shadow">
                    Komentar Modul
                </h1>
                <p class="text-indigo-100 mt-1 text-sm">
                    <?php echo e($module->title); ?>

                </p>
            </div>
        </div>

        <!-- FORM KOMENTAR -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl mb-12
                    transform transition-all duration-300 hover:shadow-2xl">

            <h3 class="text-xl font-semibold dark:text-white mb-4">
                Tambahkan Komentar
            </h3>

            <form action="<?php echo e(route('modules.comment', $module->id)); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>

                <textarea name="comment" rows="3"
                    class="w-full p-4 rounded-xl bg-gray-100 dark:bg-gray-700 
                           text-gray-800 dark:text-white border border-gray-300 
                           dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 
                           focus:border-transparent transition-all duration-200"
                    placeholder="Tulis komentar sebagai Guru..."></textarea>

                <button
                    class="px-5 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 
                           text-white rounded-xl font-medium shadow-lg 
                           hover:shadow-xl transform hover:scale-105 transition-all duration-200
                           flex items-center gap-2">
                    <i class="fas fa-paper-plane text-sm"></i>
                    Kirim Komentar
                </button>
            </form>
        </div>

        <!-- LIST KOMENTAR -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl
                    transform transition-all duration-300 hover:shadow-2xl">

            <h2 class="text-xl font-semibold dark:text-white mb-6">
                Semua Komentar
            </h2>

            <div class="space-y-6" id="commentList">
                <?php $__currentLoopData = $module->comments->where('parent_id', null); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('components.comment-bubble', [
                        'comment' => $comment,
                        'module'  => $module
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($module->comments->where('parent_id', null)->count() === 0): ?>
                <div class="text-center py-10 text-gray-500 dark:text-gray-400">
                    Belum ada komentar untuk modul ini.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>



<script>
    // ANIMASI MASUK
    document.addEventListener("DOMContentLoaded", () => {
        const bubbles = document.querySelectorAll("#commentList > *");
        bubbles.forEach((el, i) => {
            el.style.opacity = "0";
            el.style.transform = "translateY(15px)";
            setTimeout(() => {
                el.style.transition = "0.4s";
                el.style.opacity = "1";
                el.style.transform = "translateY(0)";
            }, 100 * i);
        });
    });

    // REPLY FORM TOGGLE
    function openReplyForm(id) {
        document.getElementById('reply-form-' + id).classList.toggle('hidden');
    }

    // TOGGLE REPLIES
    function toggleReplies(id) {
        const wrapper = document.getElementById('reply-wrapper-' + id);
        const text = document.getElementById('toggle-reply-text-' + id);
        const count = text.dataset.count;

        if (wrapper.classList.contains('hidden')) {
            wrapper.classList.remove('hidden');
            text.innerHTML = `Sembunyikan balasan (${count})`;
        } else {
            wrapper.classList.add('hidden');
            text.innerHTML = `Tampilkan balasan (${count})`;
        }
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guru', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/guru/modul_comments.blade.php ENDPATH**/ ?>