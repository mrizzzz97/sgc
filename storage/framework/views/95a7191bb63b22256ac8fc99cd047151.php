

<?php $__env->startSection('title', 'Daftar Murid'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="mb-8">
        <div class="md:flex md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Daftar Murid
                </h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Kelola data murid dan informasi akun mereka
                </p>
            </div>

            <a href="<?php echo e(route('admin.murid.create')); ?>"
               class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 rounded-md text-sm font-medium
                      bg-indigo-600 hover:bg-indigo-700 text-white transition shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Murid Baru
            </a>
        </div>
    </div>

    
    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border-l-4 border-green-500 text-green-700 dark:text-green-300 rounded-md">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Card -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-xl overflow-hidden">

        <?php if($murids->count() > 0): ?>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/40">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">Murid</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">Email</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <?php $__currentLoopData = $murids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $murid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">
                                            <?php echo e(strtoupper(substr($murid->name, 0, 1))); ?>

                                        </div>

                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                                                <?php echo e($murid->name); ?>

                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                ID: <?php echo e($murid->id); ?>

                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                                    <?php echo e($murid->email); ?>

                                </td>

                                <td class="px-6 py-4 text-right text-sm space-x-3">

                                    <a href="<?php echo e(route('admin.murid.edit', $murid->id)); ?>"
                                       class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                        Edit
                                    </a>

                                    <form action="<?php echo e(route('admin.murid.destroy', $murid->id)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="text-red-600 dark:text-red-400 hover:underline"
                                                onclick="return confirm('Yakin ingin menghapus murid ini?')">
                                            Hapus
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700/40 border-t border-gray-200 dark:border-gray-700">
                <?php echo e($murids->links()); ?>

            </div>

        <?php else: ?>

            <!-- Empty State -->
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>

                <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">
                    Tidak ada data murid
                </h3>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Mulai dengan menambahkan murid baru.
                </p>

                <a href="<?php echo e(route('admin.murid.create')); ?>"
                   class="mt-6 inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow">
                    Tambah Murid Baru
                </a>
            </div>

        <?php endif; ?>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\admin\murid\index.blade.php ENDPATH**/ ?>