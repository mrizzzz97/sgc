
<script src="https://cdn.tailwindcss.com"></script>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    // Konfigurasi Tailwind untuk Dark Mode
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                colors: {
                    'primary': '#4F46E5',
                    'primary-dark': '#4338CA',
                    'primary-light': '#818CF8',
                },
                animation: {
                    'float': 'float 6s ease-in-out infinite',
                },
                keyframes: {
                    float: {
                        '0%, 100%': { transform: 'translateY(0px)' },
                        '50%': { transform: 'translateY(-20px)' },
                    }
                }
            }
        }
    }
</script>

<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased transition-colors duration-300">

    
    <nav class="w-full fixed top-0 left-0 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 z-50 transition-all duration-300" id="navbar" data-aos="fade-down">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <div class="flex items-center">
                <div class="relative">
                    <div class="absolute inset-0 bg-primary opacity-20 blur-xl"></div>
                    <h1 class="text-2xl font-extrabold text-primary dark:text-primary-light relative">FrontEndClass</h1>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-6">
                <a href="#materi" class="text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium transition-colors duration-200 relative group">
                    Materi
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary dark:bg-primary-light transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#project" class="text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium transition-colors duration-200 relative group">
                    Project
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary dark:bg-primary-light transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#kelas" class="text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium transition-colors duration-200 relative group">
                    Kelas
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary dark:bg-primary-light transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>

            <div class="flex items-center gap-3">
                
                <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2.5 transition-colors duration-200">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                </button>

                <?php if(auth()->guard()->check()): ?>
                    <a href="/dashboard"
                        class="px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-dark transition-all duration-200 transform hover:scale-105 shadow-md">
                        Dashboard
                    </a>
                <?php else: ?>
                    <a href="/login"
                       class="px-5 py-2.5 border border-primary text-primary dark:text-primary-light dark:border-primary-light rounded-lg hover:bg-primary hover:text-white dark:hover:bg-primary-light dark:hover:text-gray-900 transition-all duration-200">
                        Login
                    </a>
                    <a href="/register"
                       class="px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-dark transition-all duration-200 transform hover:scale-105 shadow-md">
                        Register
                    </a>
                <?php endif; ?>

                
                <button class="md:hidden text-gray-700 dark:text-gray-300" id="mobileMenuBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        
        <div class="hidden md:hidden bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800" id="mobileMenu">
            <div class="px-6 py-4 space-y-3">
                <a href="#materi" class="block text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium">Materi</a>
                <a href="#project" class="block text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium">Project</a>
                <a href="#kelas" class="block text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium">Kelas</a>
            </div>
        </div>
    </nav>

    
    <section class="pt-32 pb-20 relative overflow-hidden">
        
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-light opacity-20 dark:opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-indigo-300 opacity-20 dark:opacity-10 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center gap-12">

            <div class="flex-1" data-aos="fade-right">
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary-light text-sm font-medium mb-6 animate-pulse">
                    <span class="w-2 h-2 bg-primary dark:bg-primary-light rounded-full mr-2"></span>
                    Belajar Front-End dari Ahlinya
                </div>

                <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6">
                    Jadi Front-End Developer,<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-light">Mulai dari Nol!</span>
                </h1>

                <p class="text-lg text-gray-600 dark:text-gray-300 max-w-md mb-8">
                    Belajar HTML, CSS, JavaScript, dan Framework modern dengan metode yang gampang dipahami.
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <a href="#materi"
                       class="w-full sm:w-auto bg-primary text-white px-7 py-3.5 rounded-xl font-semibold text-lg hover:bg-primary-dark transition-all duration-200 transform hover:scale-105 shadow-lg flex items-center justify-center">
                        Mulai Belajar ⚡
                    </a>

                    <a href="#materi"
                       class="w-full sm:w-auto text-primary dark:text-primary-light font-semibold text-lg hover:underline flex items-center justify-center">
                        Lihat Materi
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                <div class="mt-12 flex items-center gap-8" data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="text-3xl font-bold text-primary dark:text-primary-light">10K+</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Siswa Aktif</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-primary dark:text-primary-light">50+</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Materi Pembelajaran</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-primary dark:text-primary-light">95%</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Tingkat Kepuasan</div>
                    </div>
                </div>
            </div>

            <div class="flex-1 flex justify-center relative" data-aos="fade-left">
                <div class="relative animate-float">
                    <div class="absolute inset-0 bg-gradient-to-tr from-primary to-primary-light opacity-20 dark:opacity-10 rounded-3xl blur-2xl transform rotate-6"></div>
                    <img src="https://cdni.iconscout.com/illustration/premium/thumb/frontend-developer-illustration-download-in-svg-png-gif-file-formats--development-team-coding-pack-illustrations-6505574.png"
                         class="relative w-full max-w-md drop-shadow-2xl transform hover:scale-105 transition-transform duration-500">
                </div>
            </div>

        </div>
    </section>

    
    <section id="materi" class="py-24 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-3">Materi <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-light">Front-End</span></h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Dasar kuat, skill naik cepat. Materi dirancang oleh praktisi industri dengan pengalaman bertahun-tahun.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                    $materi = [
                        ['HTML Fundamental', 'Struktur dasar website', '🏗️'],
                        ['CSS Styling & Layout', 'Desain tampilan website', '🎨'],
                        ['Responsive Design', 'Website adaptif di semua device', '📱'],
                        ['JavaScript Basics', 'Logika pemrograman web', '⚙️'],
                        ['DOM Manipulation', 'Interaksi dinamis dengan HTML', '🔧'],
                        ['API & Fetch', 'Integrasi dengan backend', '🔌'],
                        ['Tailwind Framework', 'CSS modern dengan utility-first', '🚀'],
                        ['Git & Deployment', 'Version control dan hosting', '🚢']
                    ];
                ?>

                <?php $__currentLoopData = $materi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="group p-8 bg-white dark:bg-gray-900 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-700" data-aos="fade-up" data-aos-delay="<?php echo e($index * 100); ?>">
                        <div class="text-4xl mb-4"><?php echo e($m[2]); ?></div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2 group-hover:text-primary dark:group-hover:text-primary-light transition-colors"><?php echo e($m[0]); ?></h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm"><?php echo e($m[1]); ?></p>
                        <div class="mt-4 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-primary dark:bg-primary-light h-2 rounded-full transition-all duration-500" style="width: <?php echo e(rand(60, 100)); ?>%"></div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </section>

    
    <section id="project" class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-3">Project <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-light">Nyata</span></h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Belajar lewat project biar langsung kepake. Project dirancang untuk membangun portofolio yang mengesankan.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                    $project = [
                        ['Landing Page Modern', 'UI/UX, Responsive', 'https://picsum.photos/seed/landing/400/250.jpg'],
                        ['Portfolio Website', 'Personal Branding', 'https://picsum.photos/seed/portfolio/400/250.jpg'],
                        ['Mini E-Commerce UI', 'Product Showcase', 'https://picsum.photos/seed/ecommerce/400/250.jpg'],
                        ['Dashboard Admin UI', 'Data Visualization', 'https://picsum.photos/seed/dashboard/400/250.jpg']
                    ];
                ?>

                <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="group overflow-hidden rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-aos="zoom-in" data-aos-delay="<?php echo e($index * 100); ?>">
                        <div class="aspect-w-16 aspect-h-9 bg-gray-200 dark:bg-gray-700 overflow-hidden">
                            <img src="<?php echo e($p[2]); ?>" alt="<?php echo e($p[0]); ?>" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="p-6 bg-white dark:bg-gray-900">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2 group-hover:text-primary dark:group-hover:text-primary-light transition-colors"><?php echo e($p[0]); ?></h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4"><?php echo e($p[1]); ?></p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <?php echo e(rand(8, 24)); ?> jam
                                </div>
                                <a href="#" class="text-primary dark:text-primary-light font-medium text-sm hover:underline">Lihat Detail →</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </section>

    
    <section id="kelas" class="py-24 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-3">Kelas <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-light">Unggulan</span></h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Dipandu step-by-step biar makin paham. Dapatkan sertifikat setelah menyelesaikan kelas.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-10">
                <?php
                    $kelas = [
                        ['Front-End Dasar', 'Belajar HTML, CSS, JavaScript dari nol.', 'beginner', '4 minggu'],
                        ['Tailwind Mastery', 'Bikin UI modern dengan cepat.', 'intermediate', '3 minggu'],
                        ['JavaScript Intensive', 'Latihan logika & mini project.', 'intermediate', '5 minggu'],
                        ['Responsive Masterclass', 'Website rapi di semua device.', 'intermediate', '2 minggu'],
                        ['Portfolio Build', 'Bangun website personal profesional.', 'advanced', '4 minggu'],
                        ['Frontend Roadmap', 'Jalur lengkap menuju siap kerja.', 'all', '8 minggu']
                    ];
                ?>

                <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="group bg-white dark:bg-gray-900 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden" data-aos="fade-up" data-aos-delay="<?php echo e($index * 100); ?>">
                        <div class="h-2 bg-gradient-to-r from-primary to-primary-light"></div>
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-4">
                                <span class="px-3 py-1 text-xs font-medium rounded-full
                                    <?php if($c[2] === 'beginner'): ?> bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                    <?php elseif($c[2] === 'intermediate'): ?> bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                    <?php elseif($c[2] === 'advanced'): ?> bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                    <?php else: ?> bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 <?php endif; ?>">
                                    <?php if($c[2] === 'beginner'): ?> Pemula
                                    <?php elseif($c[2] === 'intermediate'): ?> Menengah
                                    <?php elseif($c[2] === 'advanced'): ?> Lanjutan
                                    <?php else: ?> Semua Level <?php endif; ?>
                                </span>
                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <?php echo e($c[3]); ?>

                                </div>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2 group-hover:text-primary dark:group-hover:text-primary-light transition-colors"><?php echo e($c[0]); ?></h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6"><?php echo e($c[1]); ?></p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex -space-x-2">
                                        <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900" src="https://picsum.photos/seed/user1/100/100.jpg" alt="">
                                        <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900" src="https://picsum.photos/seed/user2/100/100.jpg" alt="">
                                        <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900" src="https://picsum.photos/seed/user3/100/100.jpg" alt="">
                                    </div>
                                    <span class="ml-2 text-sm text-gray-500 dark:text-gray-400"><?php echo e(rand(50, 200)); ?>+ siswa</span>
                                </div>
                                <a href="#" class="text-primary dark:text-primary-light font-medium text-sm hover:underline">Daftar →</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </section>

    
    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-3">Apa Kata <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-light">Mereka</span></h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Dengar langsung dari alumni yang telah berhasil memulai karir sebagai Front-End Developer.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 dark:bg-gray-800 p-8 rounded-2xl" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center mb-4">
                        <img src="https://picsum.photos/seed/testimonial1/100/100.jpg" alt="" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold">Sarah Johnson</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">UI/UX Designer</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <?php for($i = 0; $i < 5; $i++): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300">"FrontEndClass benar-benar mengubah karir saya. Dari tidak tahu apa-apa tentang coding menjadi seorang UI/UX Designer dalam 6 bulan!"</p>
                </div>

                <div class="bg-gray-50 dark:bg-gray-800 p-8 rounded-2xl" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center mb-4">
                        <img src="https://picsum.photos/seed/testimonial2/100/100.jpg" alt="" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold">Michael Chen</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Front-End Developer</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <?php for($i = 0; $i < 5; $i++): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300">"Project-based learning di FrontEndClass sangat efektif. Saya langsung bisa apply ilmu yang dipelajari untuk membangun portofolio saya."</p>
                </div>

                <div class="bg-gray-50 dark:bg-gray-800 p-8 rounded-2xl" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center mb-4">
                        <img src="https://picsum.photos/seed/testimonial3/100/100.jpg" alt="" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold">Amanda Rodriguez</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Full-Stack Developer</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <?php for($i = 0; $i < 5; $i++): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300">"Komunitas di FrontEndClass sangat supportive. Mentor-mentornya juga sangat berpengalaman dan selalu ready membantu ketika saya stuck."</p>
                </div>
            </div>
        </div>
    </section>

    
    <section class="py-24 bg-gradient-to-r from-primary to-primary-dark">
        <div class="max-w-4xl mx-auto px-6 text-center" data-aos="zoom-in">
            <h2 class="text-4xl font-bold text-white mb-6">Siap Memulai Karir sebagai Front-End Developer?</h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">Bergabunglah dengan ribuan siswa yang telah berhasil memulai karir di dunia teknologi.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/register" class="px-8 py-4 bg-white text-primary font-semibold rounded-lg hover:bg-gray-100 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    Daftar Sekarang
                </a>
                <a href="#" class="px-8 py-4 bg-transparent text-white font-semibold rounded-lg border-2 border-white hover:bg-white hover:text-primary transition-all duration-200">
                    Download Syllabus
                </a>
            </div>
        </div>
    </section>

    
    <footer class="bg-gray-900 text-gray-400 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <div data-aos="fade-up">
                    <h3 class="text-2xl font-bold text-white mb-4">FrontEndClass</h3>
                    <p class="text-gray-500 mb-4">Platform pembelajaran Front-End Development terbaik untuk memulai karir di dunia teknologi.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM5.838 12a6.162 6.162 0 1112.324 0 6.162 6.162 0 01-12.324 0zM12 16a4 4 0 110-8 4 4 0 010 8zm4.965-10.405a1.44 1.44 0 112.881.001 1.44 1.44 0 01-2.881-.001z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="100">
                    <h4 class="text-lg font-semibold text-white mb-4">Platform</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Karir</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Partner</a></li>
                    </ul>
                </div>

                <div data-aos="fade-up" data-aos-delay="200">
                    <h4 class="text-lg font-semibold text-white mb-4">Kelas</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition-colors">Front-End Dasar</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">JavaScript Intensive</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">React Mastery</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Vue.js Fundamental</a></li>
                    </ul>
                </div>

                <div data-aos="fade-up" data-aos-delay="300">
                    <h4 class="text-lg font-semibold text-white mb-4">Bantuan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Hubungi Kami</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm">
                    © <?php echo e(date('Y')); ?> FrontEndClass. All rights reserved.
                </p>
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-500 hover:text-white text-sm transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="text-gray-500 hover:text-white text-sm transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true
        });

        // Theme toggle
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
            themeToggleDarkIcon.classList.add('hidden');
        } else {
            themeToggleLightIcon.classList.add('hidden');
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });

        // Mobile menu toggle
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-lg');
            } else {
                navbar.classList.remove('shadow-lg');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\landing.blade.php ENDPATH**/ ?>