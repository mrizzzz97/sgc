<?php
    $isGuru = $comment->user->role === 'guru';
    $auth = auth()->user();
    $replyCount = $comment->replies->count();
?>

<div class="flex <?php echo e($isGuru ? 'justify-end' : ''); ?>">

    <div class="flex gap-3 max-w-xl <?php echo e($isGuru ? 'flex-row-reverse' : ''); ?>">

        
        <img src="<?php echo e($comment->user->profile_photo 
            ? asset('storage/' . $comment->user->profile_photo)
            : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name)); ?>"
            class="w-10 h-10 rounded-full object-cover">

        
        <div class="p-4 rounded-2xl shadow
            <?php echo e($isGuru ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-white'); ?>"
            style="max-width: 80%;">

            
            <div class="flex items-center gap-2 mb-1">
                <p class="font-semibold text-sm"><?php echo e($comment->user->name); ?></p>

                <?php if($isGuru): ?>
                    <span class="px-2 py-0.5 bg-white text-indigo-600 text-[10px] rounded">
                        Guru
                    </span>
                <?php endif; ?>
            </div>

            
            <p class="text-sm leading-relaxed">
                <?php echo e($comment->comment); ?>

            </p>

            
            <div class="text-[10px] text-gray-300 mt-1">
                <?php echo e($comment->created_at->diffForHumans()); ?>

            </div>

            
            <button onclick="openReplyForm(<?php echo e($comment->id); ?>)"
                class="text-xs text-blue-300 hover:text-blue-400 mt-2">
                Balas
            </button>

            
            <?php if($auth->id === $comment->user_id || $auth->role === 'guru'): ?>
                <form action="<?php echo e(route('modules.comment.delete', $comment->id)); ?>"
                      method="POST"
                      class="inline-block ml-3">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit"
                        class="text-xs text-red-300 hover:text-red-500"
                        onclick="return confirm('Hapus komentar ini?')">
                        Hapus
                    </button>
                </form>
            <?php endif; ?>

            
            <div id="reply-form-<?php echo e($comment->id); ?>" class="hidden mt-3">
                <form action="<?php echo e(route('modules.comment', $module->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="parent_id" value="<?php echo e($comment->id); ?>">

                    <textarea name="comment"
                        class="w-full p-2 bg-gray-600 text-sm text-white rounded"
                        rows="2"
                        placeholder="Balas komentar..."></textarea>

                    <button
                        class="mt-2 px-3 py-1 bg-blue-500 hover:bg-blue-600 rounded text-xs text-white">
                        Kirim
                    </button>
                </form>
            </div>

            
            <?php if($replyCount > 0): ?>
                <button onclick="toggleReplies(<?php echo e($comment->id); ?>)"
                    class="text-xs text-gray-300 hover:text-white mt-3 block">
                    <span id="toggle-reply-text-<?php echo e($comment->id); ?>">
                        Tampilkan balasan (<?php echo e($replyCount); ?>)
                    </span>
                </button>
            <?php endif; ?>

            
            <div id="reply-wrapper-<?php echo e($comment->id); ?>" class="mt-4 space-y-4 hidden">

                <?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="ml-6">
                        <?php echo $__env->make('components.comment-bubble', [
                            'comment' => $reply,
                            'module' => $module
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>
    </div>
</div>
<?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/components/comment-bubble.blade.php ENDPATH**/ ?>