<section class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow mb-6">
    <header>
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
            <?php echo e(__('Delete Account')); ?>

        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
            Once your account is deleted, all of its resources will be permanently removed.
        </p>
    </header>

    <form method="POST" action="<?php echo e(route('profile.destroy')); ?>" class="mt-6 space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('delete'); ?>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Confirm Password
            </label>

            <input
                id="delete_password"
                name="delete_password"
                type="password"
                class="w-full mt-1 rounded-lg border-gray-300 dark:border-gray-600
                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            />

            <?php $__errorArgs = ['delete_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button class="px-5 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 shadow transition">
            DELETE ACCOUNT
        </button>
    </form>
</section>
<?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\profile\partials\delete-user-form.blade.php ENDPATH**/ ?>