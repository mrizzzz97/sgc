<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="/" class="text-xl font-bold text-indigo-600">SGC</a>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="/" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->role === 'murid'): ?>
                            <a href="<?php echo e(route('modules.index')); ?>" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">📚 Modul</a>
                        <?php elseif(Auth::user()->role === 'guru'): ?>
                            <a href="<?php echo e(route('modules.teach')); ?>" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">📚 Modul Mengajar</a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <a href="/" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Features</a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <?php if(auth()->guard()->check()): ?>
                    <span class="text-gray-700 mr-4"><?php echo e(Auth::user()->name); ?></span>
                    <a href="/dashboard" class="px-4 py-2 bg-indigo-600 text-white rounded-md mr-3">Dashboard</a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Logout</button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    <a href="<?php echo e(route('register')); ?>" class="ml-3 px-4 py-2 bg-indigo-600 text-white rounded-md">Register</a>
                <?php endif; ?>
            </div>

            <!-- Mobile menu button (optional) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon -->
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
<?php /**PATH C:\school\IDN kls 10\lomba-lomba\te\laravel\sgc\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>