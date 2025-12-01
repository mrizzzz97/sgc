<section class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow mb-6">

    <header>
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
            <?php echo e(__('Update Password')); ?>

        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
            Ensure your account is using a secure password.
        </p>
    </header>

    
    <?php if(session('status') === 'password-updated'): ?>
        <p class="mt-4 text-sm text-green-400 font-semibold">
            ✔ Password berhasil diperbarui
        </p>
    <?php endif; ?>

    <form method="post" action="<?php echo e(route('password.update')); ?>" class="mt-6 space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>

        
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Current Password
            </label>

            <input id="current_password" name="current_password" type="password"
                class="w-full mt-1 rounded-lg border-gray-300 dark:border-gray-600
                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                required />

            <?php $__errorArgs = ['current_password'];
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

        
        <div>
            <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                New Password
            </label>

            <input id="new_password" name="new_password" type="password"
                class="w-full mt-1 rounded-lg border-gray-300 dark:border-gray-600
                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                required />

            <?php $__errorArgs = ['new_password'];
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

        
        <div>
            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Confirm Password
            </label>

            <input id="new_password_confirmation" name="new_password_confirmation" type="password"
                class="w-full mt-1 rounded-lg border-gray-300 dark:border-gray-600
                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                required />
        </div>

        <button
            class="px-5 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 shadow transition">
            SAVE
        </button>
    </form>
</section>
<?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\profile\partials\update-password-form.blade.php ENDPATH**/ ?>