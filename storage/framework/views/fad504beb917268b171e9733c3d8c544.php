

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-100">
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Soal Baru</h1>
                <p class="text-gray-600 mb-6">Chapter: <?php echo e($chapter->title); ?></p>

                <form action="<?php echo e(route('questions.store', $chapter)); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Teks Soal</label>
                        <textarea name="question_text" required rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                  placeholder="Tulis soal Anda..."><?php echo e(old('question_text')); ?></textarea>
                        <?php $__errorArgs = ['question_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-600 text-sm"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Soal</label>
                        <select name="type" id="questionType" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                onchange="toggleQuestionType()">
                            <option value="">-- Pilih Tipe --</option>
                            <option value="multiple_choice" <?php echo e(old('type') === 'multiple_choice' ? 'selected' : ''); ?>>Pilihan Ganda</option>
                            <option value="essay" <?php echo e(old('type') === 'essay' ? 'selected' : ''); ?>>Essay</option>
                        </select>
                        <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-600 text-sm"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Multiple Choice Section -->
                    <div id="multipleChoiceSection" class="hidden mb-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan Jawaban</label>
                            <div id="choicesContainer" class="space-y-3">
                                <div class="flex gap-2">
                                    <input type="text" name="choices[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2"
                                           placeholder="Pilihan 1" value="<?php echo e(old('choices.0')); ?>">
                                    <input type="radio" name="correct_answer" value="" class="mt-3" <?php echo e(old('correct_answer') === (old('choices.0') ?? '') ? 'checked' : ''); ?>>
                                    <span class="text-sm text-gray-600 mt-3">Benar</span>
                                </div>
                                <div class="flex gap-2">
                                    <input type="text" name="choices[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2"
                                           placeholder="Pilihan 2" value="<?php echo e(old('choices.1')); ?>">
                                    <input type="radio" name="correct_answer" value="" class="mt-3" <?php echo e(old('correct_answer') === (old('choices.1') ?? '') ? 'checked' : ''); ?>>
                                    <span class="text-sm text-gray-600 mt-3">Benar</span>
                                </div>
                                <div class="flex gap-2">
                                    <input type="text" name="choices[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2"
                                           placeholder="Pilihan 3" value="<?php echo e(old('choices.2')); ?>">
                                    <input type="radio" name="correct_answer" value="" class="mt-3" <?php echo e(old('correct_answer') === (old('choices.2') ?? '') ? 'checked' : ''); ?>>
                                    <span class="text-sm text-gray-600 mt-3">Benar</span>
                                </div>
                                <div class="flex gap-2">
                                    <input type="text" name="choices[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2"
                                           placeholder="Pilihan 4" value="<?php echo e(old('choices.3')); ?>">
                                    <input type="radio" name="correct_answer" value="" class="mt-3" <?php echo e(old('correct_answer') === (old('choices.3') ?? '') ? 'checked' : ''); ?>>
                                    <span class="text-sm text-gray-600 mt-3">Benar</span>
                                </div>
                            </div>
                            <?php $__errorArgs = ['correct_answer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-600 text-sm"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Poin</label>
                        <input type="number" name="points" required min="1" max="100"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="<?php echo e(old('points', 10)); ?>">
                        <?php $__errorArgs = ['points'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-600 text-sm"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                        <input type="number" name="order" required min="1"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="<?php echo e(old('order', 1)); ?>">
                        <?php $__errorArgs = ['order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-600 text-sm"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                            Simpan Soal
                        </button>
                        <a href="<?php echo e(route('modules.edit', $chapter->module)); ?>" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleQuestionType() {
    const type = document.getElementById('questionType').value;
    const mcSection = document.getElementById('multipleChoiceSection');
    if (type === 'multiple_choice') {
        mcSection.classList.remove('hidden');
    } else {
        mcSection.classList.add('hidden');
    }
}

// On page load, show/hide based on current selection
document.addEventListener('DOMContentLoaded', function() {
    toggleQuestionType();
    // Update radio values to match input text
    const choiceInputs = document.querySelectorAll('#choicesContainer input[type="text"]');
    const radios = document.querySelectorAll('#choicesContainer input[type="radio"]');
    choiceInputs.forEach((input, idx) => {
        input.addEventListener('input', () => {
            radios[idx].value = input.value;
        });
        // Initialize radio value
        radios[idx].value = input.value || '';
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\questions\create.blade.php ENDPATH**/ ?>