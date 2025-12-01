

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-100">
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Detail Siswa</h1>
                        <p class="text-gray-600 mt-2">Modul: <?php echo e($module->icon); ?> <?php echo e($module->title); ?></p>
                    </div>
                    <a href="<?php echo e(route('enrollments.students', $module)); ?>" class="inline-block bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition">← Kembali ke List</a>
                </div>

                <!-- Student Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column: Student Data -->
                    <div>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h2 class="text-lg font-bold text-gray-900 mb-4">Informasi Siswa</h2>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-600">Nama</p>
                                    <p class="text-lg font-semibold text-gray-900"><?php echo e($enrollment->user->name); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Email</p>
                                    <p class="text-lg font-semibold text-gray-900"><?php echo e($enrollment->user->email); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Status Enrollment</p>
                                    <p class="mt-1">
                                        <?php if($enrollment->status === 'completed'): ?>
                                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">✓ Selesai</span>
                                        <?php elseif($enrollment->status === 'active'): ?>
                                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">⏳ Aktif</span>
                                        <?php else: ?>
                                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">✗ Berhenti</span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Total XP</p>
                                    <p class="text-lg font-semibold text-indigo-600"><?php echo e($enrollment->user->dailyXps->sum('points')); ?> XP</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Progress -->
                    <div>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h2 class="text-lg font-bold text-gray-900 mb-4">Progress Pembelajaran</h2>
                            <div class="space-y-6">
                                <div>
                                    <p class="text-sm text-gray-600 mb-2">Overall Progress</p>
                                    <div class="w-full bg-gray-200 rounded-full h-4">
                                        <div class="bg-indigo-600 h-4 rounded-full" style="width: <?php echo e($enrollment->progress); ?>%"></div>
                                    </div>
                                    <p class="text-sm text-gray-700 mt-1 font-semibold"><?php echo e($enrollment->progress); ?>% Selesai</p>
                                </div>

                                <!-- Chapter Progress -->
                                <div>
                                    <p class="text-sm text-gray-600 mb-3">Progress Per Chapter</p>
                                    <div class="space-y-2">
                                        <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $completedQuestions = $enrollment->user->answers()
                                                    ->where('chapter_id', $chapter->id)
                                                    ->where('is_correct', true)
                                                    ->count();
                                                $totalQuestions = $chapter->questions->count();
                                                $chapterProgress = $totalQuestions > 0 ? ($completedQuestions / $totalQuestions) * 100 : 0;
                                            ?>
                                            <div>
                                                <div class="flex justify-between items-center mb-1">
                                                    <p class="text-xs font-semibold text-gray-700"><?php echo e($chapter->title); ?></p>
                                                    <p class="text-xs text-gray-600"><?php echo e($completedQuestions); ?>/<?php echo e($totalQuestions); ?></p>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2">
                                                    <div class="bg-green-500 h-2 rounded-full" style="width: <?php echo e($chapterProgress); ?>%"></div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Answers Review -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-8 border-b-2 border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900">Review Pembelajaran Siswa</h2>
                </div>

                <div class="p-8">
                    <?php $__empty_1 = true; $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="mb-12 pb-8 border-b border-gray-200">
                            <div class="mb-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-4"><?php echo e($chapter->title); ?></h3>
                                
                                <!-- Video Section -->
                                <?php if($chapter->video_url): ?>
                                    <div class="mb-6">
                                        <div class="mb-3">
                                            <span class="inline-flex items-center bg-indigo-600 text-white text-sm font-semibold px-3 py-1 rounded-lg shadow">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-5.197-3.028A1 1 0 008 9.028v5.944a1 1 0 001.555.832l5.197-3.028a1 1 0 000-1.664z" />
                                                </svg>
                                                <span class="ml-2">Video Pembelajaran</span>
                                            </span>
                                        </div>

                                        <div class="relative w-full rounded-lg overflow-hidden bg-gray-900 shadow" style="padding-bottom: 56.25%;">
                                            <?php
                                                // Extract YouTube video ID from URL
                                                $videoId = '';
                                                if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $chapter->video_url, $matches)) {
                                                    $videoId = $matches[1];
                                                }
                                            ?>
                                            <?php if($videoId): ?>
                                                <iframe class="absolute top-0 left-0 w-full h-full" 
                                                        src="https://www.youtube.com/embed/<?php echo e($videoId); ?>?rel=0&showinfo=0" 
                                                        frameborder="0" 
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                        allowfullscreen></iframe>
                                                <!-- subtle play overlay for clarity on small screens -->
                                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                                    <div class="bg-black bg-opacity-30 rounded-full p-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-5.197-3.028A1 1 0 008 9.028v5.944a1 1 0 001.555.832l5.197-3.028a1 1 0 000-1.664z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800">
                                                    <p class="text-white text-center">Video tidak dapat dimuat</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Chapter Description -->
                                <?php if($chapter->description): ?>
                                    <div class="mb-6 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                                        <p class="text-sm text-gray-700"><?php echo e($chapter->description); ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php
                                $chapterAnswers = $enrollment->user->answers()
                                    ->whereIn('question_id', $chapter->questions->pluck('id'))
                                    ->get();
                            ?>

                            <?php if($chapter->questions->count() > 0): ?>
                                <div class="mb-4">
                                    <p class="text-sm font-semibold text-gray-600 mb-3">📝 Pertanyaan & Jawaban</p>
                                </div>
                                <div class="space-y-4">
                                    <?php $__currentLoopData = $chapter->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $answer = $chapterAnswers->where('question_id', $question->id)->first();
                                        ?>
                                        <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-indigo-500">
                                            <div class="flex items-start justify-between mb-2">
                                                <h4 class="font-semibold text-gray-900 flex-1"><?php echo e($question->question_text); ?></h4>
                                                <?php if($answer): ?>
                                                    <?php if($question->type === 'multiple_choice'): ?>
                                                        <?php if($answer->is_correct): ?>
                                                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold ml-2 whitespace-nowrap">✓ Benar</span>
                                                        <?php else: ?>
                                                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold ml-2 whitespace-nowrap">✗ Salah</span>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php if($answer->is_correct === null): ?>
                                                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold ml-2 whitespace-nowrap">⏳ Pending</span>
                                                        <?php elseif($answer->is_correct): ?>
                                                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold ml-2 whitespace-nowrap">✓ Disetujui</span>
                                                        <?php else: ?>
                                                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold ml-2 whitespace-nowrap">✗ Ditolak</span>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>

                                            <?php if($answer): ?>
                                                <div class="mt-3 space-y-2">
                                                    <p class="text-sm text-gray-600">
                                                        <span class="font-semibold">Jawaban Siswa:</span>
                                                        <?php echo e($answer->answer_text); ?>

                                                    </p>
                                                    <?php if($question->type === 'multiple_choice'): ?>
                                                        <p class="text-sm text-gray-600">
                                                            <span class="font-semibold">Jawaban Benar:</span>
                                                            <?php echo e($question->correct_answer); ?>

                                                        </p>
                                                    <?php endif; ?>
                                                    <?php if($answer->points_awarded): ?>
                                                        <p class="text-sm text-indigo-600 font-semibold">
                                                            +<?php echo e($answer->points_awarded); ?> XP
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else: ?>
                                                <p class="text-sm text-gray-500 italic">Siswa belum menjawab pertanyaan ini</p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php else: ?>
                                <p class="text-gray-500 italic text-sm">Belum ada pertanyaan di chapter ini</p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-gray-500">Modul ini belum memiliki chapter</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\enrollments\student-detail.blade.php ENDPATH**/ ?>