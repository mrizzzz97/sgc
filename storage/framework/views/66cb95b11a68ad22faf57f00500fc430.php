

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-8 mb-8">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">
                            <?php echo e($module->icon); ?> <?php echo e($module->title); ?>

                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 text-lg">
                            <?php echo e($module->description); ?>

                        </p>
                    </div>

                    <a href="<?php echo e(route('modules.index')); ?>"
                        class="text-indigo-600 dark:text-indigo-400 hover:underline">
                        ← Kembali
                    </a>
                </div>
            </div>


            
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

                
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden sticky top-24">
                        <div class="bg-indigo-600 px-4 py-3">
                            <h3 class="text-white font-bold">Daftar Bab</h3>
                        </div>

                        <div class="divide-y dark:divide-gray-700 max-h-96 overflow-y-auto">
                            <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="#chapter-<?php echo e($chapter->id); ?>"
                                    class="block px-4 py-3 hover:bg-indigo-50 dark:hover:bg-gray-700 border-l-4 border-transparent hover:border-indigo-600 dark:hover:border-indigo-400 transition">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                        Bab <?php echo e($index + 1); ?>: <?php echo e($chapter->title); ?>

                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>


                
                <div class="lg:col-span-3 space-y-10">

                    <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div id="chapter-<?php echo e($chapter->id); ?>"
                            class="bg-white dark:bg-gray-800 rounded-xl shadow p-8 scroll-mt-24">

                            
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">
                                <?php echo e($chapter->title); ?>

                            </h2>

                            <p class="text-gray-600 dark:text-gray-300 mb-6">
                                <?php echo e($chapter->description); ?>

                            </p>


                            
                            <div class="mb-8">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">
                                    📹 Video Pembelajaran
                                </h3>

                                <div class="aspect-video rounded-xl overflow-hidden bg-black">
                                    <iframe class="w-full h-full"
                                        src="<?php echo e($chapter->youtube_url); ?>"
                                        allowfullscreen></iframe>
                                </div>
                            </div>


                            
                            <?php
                                $questions = DB::table('questions')->where('chapter_id', $chapter->id)->get();
                            ?>

                            <?php if($questions->count() > 0): ?>
                            <div class="mb-10">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                                    📝 Soal Latihan
                                </h3>

                                <form id="questionForm-<?php echo e($chapter->id); ?>">
                                    <div class="space-y-6">
                                        <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qIndex => $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-xl border-l-4 border-indigo-600">

                                                <div class="flex justify-between items-start mb-2">
                                                    <h4 class="font-semibold text-gray-900 dark:text-white">
                                                        Soal <?php echo e($qIndex + 1); ?>

                                                    </h4>
                                                    <span class="text-indigo-600 dark:text-indigo-300 text-sm font-semibold">
                                                        <?php echo e($q->points); ?> XP
                                                    </span>
                                                </div>

                                                <p class="text-gray-700 dark:text-gray-300 mb-4">
                                                    <?php echo e($q->question_text); ?>

                                                </p>

                                                <?php if($q->type === 'multiple_choice'): ?>
                                                    <?php $choices = json_decode($q->choices, true); ?>

                                                    <?php $__currentLoopData = $choices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <label class="flex items-center text-gray-800 dark:text-gray-200">
                                                            <input type="radio"
                                                                name="answer[<?php echo e($q->id); ?>]"
                                                                value="<?php echo e($choice); ?>"
                                                                class="mr-3">
                                                            <?php echo e($choice); ?>

                                                        </label>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <?php else: ?>
                                                    <textarea name="answer[<?php echo e($q->id); ?>]" rows="3"
                                                        class="w-full rounded-lg bg-white dark:bg-gray-600 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-500 px-3 py-2"></textarea>
                                                <?php endif; ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                    <button type="button"
                                        onclick="submitAnswers(<?php echo e($chapter->id); ?>)"
                                        class="w-full mt-5 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold">
                                        Kirim Jawaban
                                    </button>
                                </form>
                            </div>
                            <?php endif; ?>


                            
                            <div class="border-t pt-8 mt-10">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                                    💬 Diskusi
                                </h3>

                                
                                <form method="POST" action="<?php echo e(route('comments.store', $chapter->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <textarea name="content" required rows="3"
                                        class="w-full rounded-lg bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 px-4 py-3 text-gray-800 dark:text-gray-200"
                                        placeholder="Tulis komentar..."></textarea>

                                    <button class="mt-3 bg-indigo-600 text-white px-5 py-2 rounded-lg">
                                        Kirim
                                    </button>
                                </form>

                                
                                <div class="space-y-4 mt-6">
                                    <?php $__currentLoopData = $chapter->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                            <div class="font-semibold text-gray-900 dark:text-white">
                                                <?php echo e($comment->user->name); ?>

                                            </div>

                                            <div class="text-gray-700 dark:text-gray-300 mt-1">
                                                <?php echo e($comment->content); ?>

                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-10 text-center">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                            🎓 Selesaikan Modul
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-6">
                            Sudah menyelesaikan semua bab?
                        </p>

                        <button onclick="openCertificateModal(<?php echo e($module->id); ?>)"
                                class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg">
                            Ambil Sertifikat
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<div id="certificateModal"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-white dark:bg-gray-800 p-8 rounded-xl w-full max-w-md">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">
            🎓 Ambil Sertifikat
        </h2>

        <form id="certificateForm" method="POST" action="">
            <?php echo csrf_field(); ?>
            <label class="text-gray-700 dark:text-gray-300">Nama Lengkap:</label>
            <input type="text" name="full_name" required
                class="w-full mt-2 rounded-lg bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 px-4 py-2 text-gray-900 dark:text-white">

            <div class="flex gap-3 mt-6">
                <button type="button" onclick="closeCertificateModal()"
                    class="flex-1 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 py-2 rounded-lg">
                    Batal
                </button>

                <button type="submit"
                    class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg">
                    Ambil
                </button>
            </div>
        </form>
    </div>
</div>


<script>
function openCertificateModal(id){
    document.getElementById('certificateForm').action = `/modules/${id}/certificate`;
    document.getElementById('certificateModal').classList.remove('hidden');
}
function closeCertificateModal(){
    document.getElementById('certificateModal').classList.add('hidden');
}
function submitAnswers(chapterId){
    alert("Fitur submit jawaban nanti aku sambung ke controller ya hon 😘");
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\modules\show.blade.php ENDPATH**/ ?>