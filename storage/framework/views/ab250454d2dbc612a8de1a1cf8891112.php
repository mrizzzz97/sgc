<?php $__env->startSection('title', 'Profile'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-4xl mx-auto space-y-10">

    
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">
            Profile Information
        </h2>

        <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>


    
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">
            Update Password
        </h2>

        <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>


    
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">
            Delete Account
        </h2>

        <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\IDN kls 10\lomba-lomba\te\laravel\sgc\resources\views/profile/edit.blade.php ENDPATH**/ ?>