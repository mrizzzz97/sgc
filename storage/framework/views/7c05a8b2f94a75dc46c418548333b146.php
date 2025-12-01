

<?php $__env->startSection('title', 'Edit Profil Guru'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-3xl mx-auto">

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-8">

        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
            Edit Profil Guru
        </h1>

        
        <?php if(session('success')): ?>
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <?php if($errors->any()): ?>
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($err); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>


        <!-- ========================= -->
        <!--  UPDATE PROFILE -->
        <!-- ========================= -->
        <form method="POST" action="<?php echo e(route('guru.profile.update')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Nama Lengkap
                </label>
                <input type="text" name="name"
                       value="<?php echo e(old('name', Auth::user()->name)); ?>"
                       required
                       class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-3 bg-gray-50 dark:bg-gray-700 dark:text-white">
            </div>

            
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Email
                </label>
                <input type="email" name="email"
                       value="<?php echo e(old('email', Auth::user()->email)); ?>"
                       required
                       class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-3 bg-gray-50 dark:bg-gray-700 dark:text-white">
            </div>

            <button type="submit"
                    class="px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
                Simpan Perubahan
            </button>
        </form>


        <hr class="my-8 border-gray-300 dark:border-gray-700">


        <!-- ========================= -->
        <!--  UPDATE PASSWORD -->
        <!-- ========================= -->
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
            Ubah Password
        </h2>

        <form method="POST" action="<?php echo e(route('guru.profile.password.update')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Password Lama
                </label>
                <input type="password" name="current_password" required
                       class="w-full border dark:border-gray-700 rounded-lg px-4 py-3 bg-gray-50 dark:bg-gray-700 dark:text-white">
            </div>

            
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Password Baru
                </label>
                <input type="password" name="new_password" required
                       class="w-full border dark:border-gray-700 rounded-lg px-4 py-3 bg-gray-50 dark:bg-gray-700 dark:text-white">
            </div>

            
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Konfirmasi Password Baru
                </label>
                <input type="password" name="new_password_confirmation" required
                       class="w-full border dark:border-gray-700 rounded-lg px-4 py-3 bg-gray-50 dark:bg-gray-700 dark:text-white">
            </div>

            <button type="submit"
                    class="px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
                Update Password
            </button>
        </form>


        <hr class="my-8 border-gray-300 dark:border-gray-700">


        <!-- ========================= -->
        <!--  DELETE ACCOUNT + MODAL -->
        <!-- ========================= -->
        <h2 class="text-xl font-semibold text-red-600 mb-4">
            Hapus Akun
        </h2>

        <button onclick="document.getElementById('deleteModal').showModal()"
                class="px-5 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold">
            Hapus Akun
        </button>


        <!-- MODAL KONFIRMASI -->
        <dialog id="deleteModal" class="rounded-xl p-0 backdrop:bg-black/50">

            <form method="POST" action="<?php echo e(route('guru.profile.destroy')); ?>"
                  class="bg-white dark:bg-gray-800 p-6 rounded-xl">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>

                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                    Konfirmasi Hapus Akun
                </h2>

                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Masukkan password akun Anda untuk menghapus akun.
                </p>

                <input type="password" name="delete_password" placeholder="Password"
                       required
                       class="w-full border dark:border-gray-700 rounded-lg px-4 py-3 bg-gray-50 dark:bg-gray-700 dark:text-white mb-4">

                <div class="flex justify-end gap-4">
                    <button type="button"
                            onclick="document.getElementById('deleteModal').close()"
                            class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg">
                        Batal
                    </button>

                    <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                        Hapus Akun
                    </button>
                </div>
            </form>

        </dialog>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guru', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\guru\profile-edit.blade.php ENDPATH**/ ?>