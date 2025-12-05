

<?php $__env->startSection('title', 'Tambah Modul'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 transition-colors duration-300">
    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">

        <!-- Header Section -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-8 transform transition-all duration-500 hover:shadow-2xl">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
                <div class="flex items-center">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-white">Tambah Modul</h1>
                        <p class="text-indigo-100 mt-1">Buat modul pembelajaran baru</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500 hover:shadow-2xl">
            <form action="<?php echo e(route('guru.modul.store')); ?>" method="POST" class="p-6 md:p-8">
                <?php echo csrf_field(); ?>

                <!-- Title Field -->
                <div class="mb-6 group">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Judul Modul
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6" />
                            </svg>
                        </div>
                        <input type="text" id="title" name="title"
                               class="w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white 
                                      focus:ring-2 focus:ring-indigo-500 focus:border-transparent 
                                      transition-all duration-200 transform focus:scale-[1.02]"
                               placeholder="Masukkan judul modul" required>
                    </div>
                </div>

                <!-- Description Field -->
                <div class="mb-6 group">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Deskripsi Modul
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </div>
                        <textarea id="description" name="description" rows="4"
                                  class="w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                                         bg-white dark:bg-gray-700 text-gray-900 dark:text-white 
                                         focus:ring-2 focus:ring-indigo-500 focus:border-transparent 
                                         transition-all duration-200 transform focus:scale-[1.02]"
                                  placeholder="Masukkan deskripsi modul" required></textarea>
                    </div>
                </div>

                <!-- Order Field -->
                <div class="mb-8 group">
                    <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Urutan Modul
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6" />
                            </svg>
                        </div>
                        <input type="number" id="order" name="order" min="1"
                               class="w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white 
                                      focus:ring-2 focus:ring-indigo-500 focus:border-transparent 
                                      transition-all duration-200 transform focus:scale-[1.02]"
                               placeholder="Contoh: 1" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white 
                                   font-medium rounded-lg shadow-lg hover:shadow-xl transform 
                                   transition-all duration-200 hover:scale-105 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Modul
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const fields = document.querySelectorAll('.group');
        fields.forEach((el, i) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            setTimeout(() => {
                el.style.transition = '0.5s';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, i * 100);
        });

        const btn = document.querySelector('button[type="submit"]');
        btn.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');

            this.appendChild(ripple);

            setTimeout(() => ripple.remove(), 600);
        });
    });
</script>

<style>
    .ripple {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(255,255,255,0.5);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    button { position: relative; overflow: hidden; }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guru', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/guru/modul/create.blade.php ENDPATH**/ ?>