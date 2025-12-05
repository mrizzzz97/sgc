<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGC</title>

    <!-- FAVICON -->
    <link rel="shortcut icon" href="<?php echo e(asset('img/sgc-logo.png')); ?>" type="image/x-icon">
    
    <!-- TAILWIND CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- AOS CDN -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- GSAP CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CUSTOM FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- PARTICLES JS -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --primary-light: #818cf8;
            --accent: #14b8a6;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        /* ---------------------- */
        /* Scrollbar (soft style) */
        /* ---------------------- */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f5f5f5;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        /* ========================== */
        /*         LOADING SCREEN     */
        /* ========================== */

        .loader-wrapper {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, #ffffff, #f2f4ff);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            overflow: hidden;
            animation: loaderFadeOut 0.6s ease forwards;
            animation-delay: 1.6s;
        }

        /* Fade-out */
        @keyframes loaderFadeOut {
            to {
                opacity: 0;
                visibility: hidden;
            }
        }

        /* Logo */
        .loader-logo {
            position: absolute;
            width: 75px;
            height: 75px;
            z-index: 10;
            filter: drop-shadow(0 0 20px rgba(99,102,241,0.35));
        }

        /* Glow */
        .loader-glow {
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--primary), var(--secondary));
            filter: blur(70px);
            opacity: 0.25;
            animation: glowFloat 6s ease-in-out infinite;
        }

        /* Glow animation */
        @keyframes glowFloat {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        /* Spinning ring */
        .loader-ring {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 4px solid transparent;
            border-top-color: var(--primary);
            border-right-color: var(--secondary);
            animation: loaderSpin 1.4s linear infinite;
        }

        /* Spin */
        @keyframes loaderSpin {
            to { transform: rotate(360deg); }
        }

        /* Text */
        .loader-text {
            position: absolute;
            top: calc(50% + 95px);
            font-size: 18px;
            font-weight: 600;
            color: var(--primary);
            opacity: 0;
            animation: fadeInUp 1s ease forwards 0.5s;
        }

        /* Smooth text fade-in */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Blob animations */
        @keyframes blobMove1 {
            0%,100% { transform: translate(0,0) scale(1); }
            50% { transform: translate(40px, -60px) scale(1.15); }
        }
        @keyframes blobMove2 {
            0%,100% { transform: translate(0,0) scale(1); }
            50% { transform: translate(-50px, 40px) scale(1.1); }
        }
        @keyframes blobMove3 {
            0%,100% { transform: translate(0,0) scale(1); }
            50% { transform: translate(20px, 30px) scale(0.95); }
        }

        .animate-blob-1 { animation: blobMove1 9s ease-in-out infinite; }
        .animate-blob-2 { animation: blobMove2 11s ease-in-out infinite; }
        .animate-blob-3 { animation: blobMove3 13s ease-in-out infinite; }

        /* Fade-up animation utility */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up {
            animation: fadeUp 1.1s ease forwards;
        }

        /* ---------------------- */
        /* Navbar blur */
        /* ---------------------- */
        .navbar-blur {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* ---------------------- */
        /* Gradient text */
        /* ---------------------- */
        .gradient-text {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            color: transparent;
        }

        /* ---------------------- */
        /* Floating animation */
        /* ---------------------- */
        .float-element {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* ---------------------- */
        /* Card hover */
        /* ---------------------- */
        .card-hover {
            transition: all 0.35s ease;
        }
        .card-hover:hover {
            transform: translateY(-8px);
        }

        /* ---------------------- */
        /* Module card highlight */
        /* ---------------------- */
        .module-card {
            position: relative;
            overflow: hidden;
        }
        .module-card::before {
            content: '';
            position: absolute;
            inset: 0;
            left: -100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
            transition: left 0.5s ease;
        }
        .module-card:hover::before {
            left: 100%;
        }

        /* ---------------------- */
        /* Team card flip */
        /* ---------------------- */
        /* ---------------------- */
        /* Buttons soft effect */
        /* ---------------------- */
        .btn-animated {
            overflow: hidden;
            position: relative;
        }
        .btn-animated::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255,255,255,0.1);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        .btn-animated:hover::before {
            transform: translateX(0);
        }

        nav svg {
            transform: none !important;
            animation: none !important;
        }
    

        .nav-item .nav-underline {
            position: absolute;
            left: 50%;
            bottom: -4px;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-item:hover .nav-underline {
            width: 100%;
        }


        .nav-item .nav-underline {
            position: absolute;
            left: 50%;
            bottom: -3px;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-item:hover .nav-underline {
            width: 100%;
        }

        .footer-title {
            @apply text-xl font-semibold text-gray-900 dark:text-white mb-4;
        }
        .footer-list li a {
            @apply text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition block py-1;
        }
        .social-icon {
            @apply w-10 h-10 rounded-xl bg-white/50 dark:bg-white/10 backdrop-blur 
                flex items-center justify-center text-gray-700 dark:text-gray-300 
                text-lg shadow-sm border border-white/40 dark:border-white/10
                transition-all duration-300 hover:-translate-y-1 hover:shadow-lg 
                hover:text-blue-600 dark:hover:text-blue-400;
        }
    </style>

    
    
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased transition-colors duration-300 overflow-x-hidden">

    
    <!-- LOADER -->
    <div class="loader-wrapper">
        <div class="loader-glow"></div>

        <img src="<?php echo e(asset('img/sgc-logo.png')); ?>" class="loader-logo" />

        <div class="loader-ring"></div>

        <div class="loader-text">Memuat...</div>
    </div>
  
    <!-- NAVBAR -->
    <nav id="navbar"
        class="fixed top-6 left-1/2 -translate-x-1/2 w-[92%] md:w-4/5 lg:w-2/3 z-50
                bg-white/60 dark:bg-gray-900/50 backdrop-blur-xl
                border border-white/40 dark:border-gray-700/40
                rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.05)]
                transition-all duration-500">

        <div class="flex items-center justify-between px-6 py-4">

            <!-- LOGO -->
            <a href="#" class="flex items-center gap-3 select-none">
                <img src="<?php echo e(asset('img/sgc-logo.png')); ?>" class="h-10 md:h-12 drop-shadow-sm" />
            </a>

            <!-- DESKTOP MENU -->
            <div class="hidden md:flex items-center gap-8">

                <a href="#materi" class="nav-item font-medium text-gray-700 dark:text-gray-300 relative">
                    Materi
                    <span class="nav-underline"></span>
                </a>

                <a href="#visi-misi" class="nav-item font-medium text-gray-700 dark:text-gray-300 relative">
                    Visi & Misi
                    <span class="nav-underline"></span>
                </a>

                <a href="#why-sgc" class="nav-item font-medium text-gray-700 dark:text-gray-300 relative">
                    Why SGC
                    <span class="nav-underline"></span>
                </a>

                <a href="#tim" class="nav-item font-medium text-gray-700 dark:text-gray-300 relative">
                    Tim Kami
                    <span class="nav-underline"></span>
                </a>

                <a href="#apa-kata-mereka" class="nav-item font-medium text-gray-700 dark:text-gray-300 relative">
                    Apa Kata Mereka
                    <span class="nav-underline"></span>
                </a>

            </div>

            <!-- RIGHT BUTTONS -->
            <div class="flex items-center gap-4">

                <!-- DARK MODE (SUN ICON TIDAK DIUBAH) -->
                <button id="theme-toggle"
                        class="p-2 rounded-xl hover:bg-gray-200/60 dark:hover:bg-gray-700/60 transition">

                    <svg id="theme-toggle-light-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" stroke-width="2">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>

                    <svg id="theme-toggle-dark-icon" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707 8 8 0 1017.293 13.293z"></path>
                    </svg>

                </button>

                <a href="/dashboard"
                class="px-5 py-2.5 rounded-xl font-semibold text-white bg-primary
                        hover:bg-primary-dark transition-all duration-200 shadow-md hover:shadow-xl">
                    Dashboard
                </a>

                <!-- MOBILE MENU BUTTON -->
                <button class="md:hidden" id="mobileMenuBtn">
                    <i class="fa-solid fa-bars text-2xl"></i>
                </button>
            </div>

        </div>

        <!-- MOBILE MENU -->
        <div id="mobileMenu" class="hidden px-6 pb-4 md:hidden space-y-3">

            <a href="#materi" class="block py-2 font-medium">Materi</a>
            <a href="#visi-misi" class="block py-2 font-medium">Visi & Misi</a>
            <a href="#why-sgc" class="block py-2 font-medium">Why SGC</a>
            <a href="#tim" class="block py-2 font-medium">Tim Kami</a>
            <a href="#apa-kata-mereka" class="block py-2 font-medium">Apa Kata Mereka</a>

        </div>
    </nav>


    <!-- HERO SECTION  -->
    <section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden pt-40 pb-32">

        <!-- Animated Background -->
        <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none">
            
            <!-- Floating Blobs -->
            <div class="blob blob-1 animate-blob-1"></div>
            <div class="blob blob-2 animate-blob-2"></div>
            <div class="blob blob-3 animate-blob-3"></div>

            <!-- Particles -->
            <div id="particles-js"></div>
        </div>

        <div class="container mx-auto px-6 text-center relative z-10">

            <!-- Small Subtitle -->
            <p class="uppercase tracking-widest text-primary text-sm font-semibold mb-6 opacity-0 animate-fade-up [animation-delay:200ms]">
                Skill Grow Craft(SGC)
            </p>

            <!-- MAIN TITLE -->
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight leading-[1.1] mb-8 opacity-0 animate-fade-up [animation-delay:400ms]">
                Belajar Skill Digital Lebih Mudah<br>
                <span class="text-primary dark:text-primary-light">
                    Praktis & Terstruktur
                </span>
            </h1>

            <!-- Description -->
            <p class="hero-subtitle text-xl md:text-2x text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed mb-12 opacity-0 animate-fade-up [animation-delay:600ms]">
                Belajar dari dasar hingga mahir dalam alur yang jelas, interaktif, dan mudah diikuti. 
                Tanpa ribet, tanpa bingung — semuanya dibuat supaya kamu cepat paham.
            </p>

            <!-- CTA -->
            <div class="hero-buttons flex flex-col sm:flex-row justify-center gap-4 opacity-0 animate-fade-up [animation-delay:800ms]">
                <a href="/dashboard"
                class="px-10 py-4 bg-primary text-white rounded-xl shadow-lg font-semibold 
                        hover:bg-primary-dark transition-all duration-200 hover:scale-[1.04]">
                    Mulai Belajar
                </a>

                <a href="#materi"
                class="px-10 py-4 border border-primary text-primary rounded-xl font-semibold 
                        hover:bg-primary/10 transition-all duration-200">
                    Lihat Materi
                </a>
            </div>

        </div>
    </section>

    <!-- MATERI -->
    <section id="materi" class="py-24 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-6">

            <!-- Title -->
            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold mb-4">Materi <span class="text-blue-600 dark:text-blue-400">Pembelajaran</span></h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Dari dasar hingga mahir, materi kami dirancang untuk membantu Anda menguasai skill digital.
                </p>
            </div>

            <!-- GRID -->
            <div class="grid md:grid-cols-2 lg:grid-cols-5 gap-6">

                <!-- MODULE CARD -->
                <div class="relative group p-6 rounded-xl bg-white dark:bg-gray-800 shadow-sm 
                    transition-all duration-300 hover:-translate-y-2 hover:shadow-lg">

                    <!-- border gradient halus -->
                    <div class="absolute inset-0 rounded-xl opacity-0 group-hover:opacity-100 
                        transition-all duration-500 pointer-events-none
                        bg-gradient-to-br from-blue-400/20 to-purple-400/20 blur-sm"></div>

                    <!-- content -->
                    <div class="relative z-10">
                        <div class="text-4xl mb-4 transition-all duration-300 
                            group-hover:scale-110 group-hover:-translate-y-1">
                            🌼
                        </div>

                        <h3 class="text-lg font-semibold mb-2">
                            Kenalan Dengan Website
                        </h3>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Dasar-dasar dunia website & cara kerjanya.
                        </p>
                    </div>

                </div>

                <!-- MODULE 2 -->
                <div class="relative group p-6 rounded-xl bg-white dark:bg-gray-800 shadow-sm 
                    transition-all duration-300 hover:-translate-y-2 hover:shadow-lg">

                    <div class="absolute inset-0 rounded-xl opacity-0 group-hover:opacity-100 
                        transition-all duration-500 bg-gradient-to-br from-pink-400/20 to-purple-400/20 blur-sm"></div>

                    <div class="relative z-10">
                        <div class="text-4xl mb-4 transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-1">
                            📄
                        </div>

                        <h3 class="text-lg font-semibold mb-2">HTML Dasar</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Belajar struktur & tag-tag dasar HTML.</p>
                    </div>
                </div>

                <!-- MODULE 3 -->
                <div class="relative group p-6 rounded-xl bg-white dark:bg-gray-800 shadow-sm 
                    transition-all duration-300 hover:-translate-y-2 hover:shadow-lg">
                    
                    <div class="absolute inset-0 rounded-xl opacity-0 group-hover:opacity-100 
                        transition-all duration-500 bg-gradient-to-br from-yellow-400/20 to-pink-400/20 blur-sm"></div>

                    <div class="relative z-10">
                        <div class="text-4xl mb-4 transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-1">
                            🎨
                        </div>

                        <h3 class="text-lg font-semibold mb-2">CSS Dasar</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Membuat tampilan website lebih cantik.</p>
                    </div>
                </div>

                <!-- MODULE 4 -->
                <div class="relative group p-6 rounded-xl bg-white dark:bg-gray-800 shadow-sm 
                    transition-all duration-300 hover:-translate-y-2 hover:shadow-lg">

                    <div class="absolute inset-0 rounded-xl opacity-0 group-hover:opacity-100 
                        transition-all duration-500 bg-gradient-to-br from-green-400/20 to-blue-400/20 blur-sm"></div>

                    <div class="relative z-10">
                        <div class="text-4xl mb-4 transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-1">
                            🧩
                        </div>

                        <h3 class="text-lg font-semibold mb-2">Layout Dasar</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Belajar Flexbox & Grid untuk layout.</p>
                    </div>
                </div>

                <!-- MODULE 5 -->
                <div class="relative group p-6 rounded-xl bg-white dark:bg-gray-800 shadow-sm 
                    transition-all duration-300 hover:-translate-y-2 hover:shadow-lg">

                    <div class="absolute inset-0 rounded-xl opacity-0 group-hover:opacity-100 
                        transition-all duration-500 bg-gradient-to-br from-blue-400/20 to-cyan-400/20 blur-sm"></div>

                    <div class="relative z-10">
                        <div class="text-4xl mb-4 transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-1">
                            📱💻
                        </div>

                        <h3 class="text-lg font-semibold mb-2">Responsive Dasar</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Website rapi di HP sampai laptop.</p>
                    </div>
                </div>

                <!-- MODULE 6 -->
                <div class="relative group p-6 rounded-xl bg-white dark:bg-gray-800 shadow-sm 
                    transition-all duration-300 hover:-translate-y-2 hover:shadow-lg">

                    <div class="absolute inset-0 rounded-xl opacity-0 group-hover:opacity-100 
                        transition-all duration-500 bg-gradient-to-br from-yellow-400/20 to-orange-400/20 blur-sm"></div>

                    <div class="relative z-10">
                        <div class="text-4xl mb-4 transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-1">
                            ⚡
                        </div>

                        <h3 class="text-lg font-semibold mb-2">JavaScript Dasar</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Belajar logika & interaksi website.</p>
                    </div>
                </div>

                <!-- MODULE 7 -->
                <div class="relative group p-6 rounded-xl bg-white dark:bg-gray-800 shadow-sm 
                    transition-all duration-300 hover:-translate-y-2 hover:shadow-lg">

                    <div class="absolute inset-0 rounded-xl opacity-0 group-hover:opacity-100 
                        transition-all duration-500 bg-gradient-to-br from-purple-400/20 to-pink-400/20 blur-sm"></div>

                    <div class="relative z-10">
                        <div class="text-4xl mb-4 transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-1">
                            🧠✨
                        </div>

                        <h3 class="text-lg font-semibold mb-2">JavaScript Interaktif</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Event, popup, dan fitur interaktif.</p>
                    </div>
                </div>

                <!-- MODULE 8 -->
                <div class="relative group p-6 rounded-xl bg-white dark:bg-gray-800 shadow-sm 
                    transition-all duration-300 hover:-translate-y-2 hover:shadow-lg">

                    <div class="absolute inset-0 rounded-xl opacity-0 group-hover:opacity-100 
                        transition-all duration-500 bg-gradient-to-br from-orange-400/20 to-red-400/20 blur-sm"></div>

                    <div class="relative z-10">
                        <div class="text-4xl mb-4 transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-1">
                            🗂
                        </div>

                        <h3 class="text-lg font-semibold mb-2">Git Pemula</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Belajar version control GitHub.</p>
                    </div>
                </div>

                <!-- MODULE 9 -->
                <div class="relative group p-6 rounded-xl bg-white dark:bg-gray-800 shadow-sm 
                    transition-all duration-300 hover:-translate-y-2 hover:shadow-lg">

                    <div class="absolute inset-0 rounded-xl opacity-0 group-hover:opacity-100 
                        transition-all duration-500 bg-gradient-to-br from-blue-400/20 to-violet-400/20 blur-sm"></div>

                    <div class="relative z-10">
                        <div class="text-4xl mb-4 transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-1">
                            🎛
                        </div>

                        <h3 class="text-lg font-semibold mb-2">CSS Framework</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Bootstrap & Tailwind modern.</p>
                    </div>
                </div>

                <!-- MODULE 10 -->
                <div class="relative group p-6 rounded-xl bg-white dark:bg-gray-800 shadow-sm 
                    transition-all duration-300 hover:-translate-y-2 hover:shadow-lg">

                    <div class="absolute inset-0 rounded-xl opacity-0 group-hover:opacity-100 
                        transition-all duration-500 bg-gradient-to-br from-green-400/20 to-blue-400/20 blur-sm"></div>

                    <div class="relative z-10">
                        <div class="text-4xl mb-4 transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-1">
                            🏆
                        </div>

                        <h3 class="text-lg font-semibold mb-2">Mini Project</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Project pertama & publish.</p>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- VISI & MISI  -->
    <section id="visi-misi" class="py-24 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-6">

            <!-- Title -->
            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold mb-4 tracking-wide">
                    Visi & <span class="text-blue-600 dark:text-blue-400">Misi</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto text-lg">
                    Tujuan kami adalah menciptakan generasi muda Indonesia yang unggul di era digital.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-14 items-start">

                <!-- VISI CARD -->
                <div>
                    <div class="relative group rounded-2xl p-10 bg-white dark:bg-gray-800 shadow-md
                        transition-all duration-500 hover:-translate-y-2 hover:shadow-xl">

                        <!-- Border halus muncul saat hover -->
                        <div class="absolute inset-0 rounded-2xl border border-transparent 
                            group-hover:border-gray-300 dark:group-hover:border-gray-700 
                            transition-all duration-500 pointer-events-none">
                        </div>

                        <h3 class="text-3xl font-bold mb-6 flex items-center">
                            <i class="fas fa-eye text-blue-600 dark:text-blue-400 mr-3 text-3xl
                                transition-all duration-500 group-hover:-translate-y-1 group-hover:scale-110"></i> 
                            Visi
                        </h3>

                        <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed">
                            “Menciptakan generasi muda Indonesia yang melek teknologi, kompeten digital,
                            dan siap bersaing di kancah global.”
                        </p>
                    </div>
                </div>

                <!-- MISI LIST -->
                <div>
                    <h3 class="text-3xl font-bold mb-6 flex items-center">
                        <i class="fas fa-bullseye text-blue-600 dark:text-blue-400 mr-3 text-3xl"></i> 
                        Misi
                    </h3>

                    <ul class="space-y-5">

                        <!-- ITEM -->
                        <li class="group flex items-start bg-gray-50 dark:bg-gray-800 p-4 rounded-xl 
                            shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md">

                            <i class="fas fa-check-circle text-blue-600 dark:text-blue-400 mt-1 mr-3 text-xl
                                transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-0.5"></i>

                            <span class="text-gray-700 dark:text-gray-300 text-lg">
                                Meningkatkan literasi digital di seluruh penjuru Indonesia.
                            </span>
                        </li>

                        <li class="group flex items-start bg-gray-50 dark:bg-gray-800 p-4 rounded-xl 
                            shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md">

                            <i class="fas fa-check-circle text-blue-600 dark:text-blue-400 mt-1 mr-3 text-xl
                                transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-0.5"></i>

                            <span class="text-gray-700 dark:text-gray-300 text-lg">
                                Membekali skill digital praktis dan relevan dengan kebutuhan global.
                            </span>
                        </li>

                        <li class="group flex items-start bg-gray-50 dark:bg-gray-800 p-4 rounded-xl 
                            shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md">

                            <i class="fas fa-check-circle text-blue-600 dark:text-blue-400 mt-1 mr-3 text-xl
                                transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-0.5"></i>

                            <span class="text-gray-700 dark:text-gray-300 text-lg">
                                Mendorong kreativitas & inovasi lewat pembelajaran aplikatif.
                            </span>
                        </li>

                        <li class="group flex items-start bg-gray-50 dark:bg-gray-800 p-4 rounded-xl 
                            shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md">

                            <i class="fas fa-check-circle text-blue-600 dark:text-blue-400 mt-1 mr-3 text-xl
                                transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-0.5"></i>

                            <span class="text-gray-700 dark:text-gray-300 text-lg">
                                Membuka peluang pembelajaran inklusif tanpa batas geografis.
                            </span>
                        </li>

                        <li class="group flex items-start bg-gray-50 dark:bg-gray-800 p-4 rounded-xl 
                            shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md">

                            <i class="fas fa-check-circle text-blue-600 dark:text-blue-400 mt-1 mr-3 text-xl
                                transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-0.5"></i>

                            <span class="text-gray-700 dark:text-gray-300 text-lg">
                                Menyiapkan generasi muda agar siap bersaing secara global.
                            </span>
                        </li>

                        <li class="group flex items-start bg-gray-50 dark:bg-gray-800 p-4 rounded-xl 
                            shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md">

                            <i class="fas fa-check-circle text-blue-600 dark:text-blue-400 mt-1 mr-3 text-xl
                                transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-0.5"></i>

                            <span class="text-gray-700 dark:text-gray-300 text-lg">
                                Membangun komunitas belajar yang positif & kolaboratif.
                            </span>
                        </li>

                    </ul>
                </div>

            </div>
        </div>
    </section>



    <!-- WHY SGC  -->
    <section id="why-sgc" class="py-24 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-6">

            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold mb-4 tracking-wide">
                    Kenapa Memilih <span class="text-blue-600 dark:text-blue-400">Skill Grow Craft?</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto text-lg">
                    Kami hadir untuk jadi tempat belajar digital terbaik dan paling ramah pemula.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-10">

                <!-- CARD -->
                <div class="relative group bg-white dark:bg-gray-900 rounded-2xl p-10
                    shadow-md transition-all duration-500
                    hover:-translate-y-3 hover:shadow-xl">

                    <!-- outline halus muncul saat hover -->
                    <div class="absolute inset-0 rounded-2xl border border-transparent
                        group-hover:border-gray-300 dark:group-hover:border-gray-700
                        transition-all duration-500 pointer-events-none"></div>

                    <!-- ICON -->
                    <div class="text-gray-900 dark:text-gray-200 text-4xl mb-5
                        transition-all duration-500 
                        group-hover:-translate-y-1 group-hover:scale-110 opacity-80">
                        <i class="fas fa-book-reader"></i>
                    </div>

                    <h3 class="text-xl font-bold mb-3">Materi Mudah Dipahami</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Disusun khusus buat pemula, step-by-step, nggak ribet.
                    </p>
                </div>

                <!-- CARD -->
                <div class="relative group bg-white dark:bg-gray-900 rounded-2xl p-10
                    shadow-md transition-all duration-500
                    hover:-translate-y-3 hover:shadow-xl">

                    <div class="absolute inset-0 rounded-2xl border border-transparent
                        group-hover:border-gray-300 dark:group-hover:border-gray-700
                        transition-all duration-500 pointer-events-none"></div>

                    <div class="text-gray-900 dark:text-gray-200 text-4xl mb-5
                        transition-all duration-500 
                        group-hover:-translate-y-1 group-hover:scale-110 opacity-80">
                        <i class="fas fa-laptop-code"></i>
                    </div>

                    <h3 class="text-xl font-bold mb-3">Belajar Dengan Praktik</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Setiap modul langsung ada contoh & latihan, biar cepat ngerti.
                    </p>
                </div>

                <!-- CARD -->
                <div class="relative group bg-white dark:bg-gray-900 rounded-2xl p-10
                    shadow-md transition-all duration-500
                    hover:-translate-y-3 hover:shadow-xl">

                    <div class="absolute inset-0 rounded-2xl border border-transparent
                        group-hover:border-gray-300 dark:group-hover:border-gray-700
                        transition-all duration-500 pointer-events-none"></div>

                    <div class="text-gray-900 dark:text-gray-200 text-4xl mb-5
                        transition-all duration-500 
                        group-hover:-translate-y-1 group-hover:scale-110 opacity-80">
                        <i class="fas fa-users"></i>
                    </div>

                    <h3 class="text-xl font-bold mb-3">Komunitas Supportif</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Tempat diskusi, tanya jawab, & berkembang bareng.
                    </p>
                </div>

            </div>
        </div>
    </section>

    
    <!-- TIM KAMI  -->
    <section id="tim" class="py-24 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-6">

            <div class="text-center mb-20">
                <h2 class="text-4xl font-extrabold mb-4">
                    Tim <span class="text-blue-600 dark:text-blue-400">Kami</span>
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-10">

                <!-- CARD -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg 
                    transition-all duration-500 hover:-translate-y-3 hover:shadow-xl">

                    <!-- Soft border hover -->
                    <div class="absolute inset-0 rounded-2xl border border-transparent
                        group-hover:border-blue-400/40 dark:group-hover:border-blue-300/30
                        transition-all duration-500 pointer-events-none"></div>

                    <div class="relative z-10 text-center">

                        <!-- Rounded Elegant Avatar -->
                        <div class="mx-auto mb-6 w-32 h-32 rounded-2xl overflow-hidden 
                            shadow-sm group-hover:shadow-blue-400/30 
                            transition-all duration-500 group-hover:scale-105">

                            <img src="<?php echo e(asset('img/rizki.png')); ?>"
                                class="object-cover w-full h-full">
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">
                            Muhammad <span class="bg-gradient-to-r from-blue-500 to-blue-300 bg-clip-text text-transparent font-extrabold">
                                Rizki
                            </span> Suryapratama
                        </h3>   


                        <p class="text-blue-600 dark:text-blue-300 font-semibold mb-3">
                            Full Stack Web Developer
                        </p>

                        <!-- BUTTON -->
                        <a href="https://rizki-portfolio-self.vercel.app/"
                        class="inline-block px-5 py-2 rounded-lg font-semibold text-sm bg-blue-600 text-white shadow-md transition-all duration-300 hover:bg-blue-700 hover:-translate-y-1"
                        target="_blank" rel="noopener noreferrer">
                            Lihat Portfolio →
                        </a>

                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg 
                    transition-all duration-500 hover:-translate-y-3 hover:shadow-xl">

                    <div class="absolute inset-0 rounded-2xl border border-transparent
                        group-hover:border-pink-400/40 dark:group-hover:border-pink-300/30
                        transition-all duration-500 pointer-events-none"></div>

                    <div class="relative z-10 text-center">

                        <div class="mx-auto mb-6 w-32 h-32 rounded-2xl overflow-hidden 
                            shadow-sm group-hover:shadow-pink-400/30 
                            transition-all duration-500 group-hover:scale-105">

                            <img src="<?php echo e(asset('img/rakha.jpg')); ?>"
                                class="object-cover w-full h-full">
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">
                            <span class="bg-gradient-to-r from-blue-500 to-blue-300 bg-clip-text text-transparent font-extrabold">
                                Rakha
                            </span> 
                            Maulana Raziq Tisnanda Siregar
                        </h3>

                        <p class="text-blue-600 dark:text-blue-300 font-semibold mb-3">
                            Front-End Web Developer
                        </p>

                        <a href="https://mebakha-portofolio.vercel.app/"
                        class="inline-block px-5 py-2 rounded-lg font-semibold text-sm bg-blue-600 text-white shadow-md transition-all duration-300 hover:bg-blue-700 hover:-translate-y-1"
                        target="_blank" rel="noopener noreferrer">
                            Lihat Portfolio →
                        </a>
                        
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg 
                    transition-all duration-500 hover:-translate-y-3 hover:shadow-xl">

                    <div class="absolute inset-0 rounded-2xl border border-transparent
                        group-hover:border-cyan-400/40 dark:group-hover:border-cyan-300/30
                        transition-all duration-500 pointer-events-none"></div>

                    <div class="relative z-10 text-center">

                        <div class="mx-auto mb-6 w-32 h-32 rounded-2xl overflow-hidden 
                            shadow-sm group-hover:shadow-cyan-400/30 
                            transition-all duration-500 group-hover:scale-105">

                            <img src="<?php echo e(asset('img/azhar.jpg')); ?>"
                                class="object-cover w-full h-full">
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">
                            Rezky 
                            <span class="bg-gradient-to-r from-blue-500 to-blue-300 bg-clip-text text-transparent font-extrabold">
                                Azhar
                            </span> 
                            Suryaputra
                        </h3>

                        <p class="text-blue-600 dark:text-blue-300 font-semibold mb-3">
                            Front-End Web Developer
                        </p>


                        <a href="https://azhar-portofolio-mu.vercel.app/"
                        class="inline-block px-5 py-2 rounded-lg font-semibold text-sm bg-blue-600 text-white shadow-md transition-all duration-300 hover:bg-blue-700 hover:-translate-y-1"
                        target="_blank" rel="noopener noreferrer">
                            Lihat Portfolio →
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
 
    
    <!-- SECTION -->
    <section class="py-32 bg-gray-100 dark:bg-[#0F172A] transition-colors duration-300" id="apa-kata-mereka">
        <div class="container mx-auto px-6 text-center">

            <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Apa Kata <span class="text-blue-600 dark:text-blue-400">Mereka</span>
            </h2>

            <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-16 text-lg">
                Cerita jujur dari mereka yang lagi belajar di SGC dan ngerasain sendiri perkembangan skill-nya hari demi hari.
            </p>

            <!-- Grid Testimoni -->
            <div class="grid md:grid-cols-3 gap-10">

                <!-- CARD 1 -->
                <div class="group bg-white dark:bg-[#111827] p-8 rounded-2xl shadow-xl border 
                            border-gray-200 dark:border-white/10 transition-all duration-300 
                            hover:-translate-y-3 hover:shadow-2xl hover:border-purple-500/40
                            hover:dark:border-purple-400/40">

                    <img src="https://i.pravatar.cc/150?img=47"
                        class="w-20 h-20 rounded-full mx-auto mb-5 object-cover transition-all duration-300
                            group-hover:scale-110 group-hover:rotate-3" />

                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white
                            transition-opacity duration-300 group-hover:opacity-90">
                        Farhan Rizqy
                    </h3>

                    <p class="text-purple-600 dark:text-purple-300 text-sm mb-4
                            transition-transform duration-300 group-hover:translate-y-1">
                        Frontend Student
                    </p>

                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed 
                            transition-all duration-300 group-hover:text-gray-800
                            dark:group-hover:text-gray-200">
                        “Jujur awalnya tuh aku gabut banget belajar HTML. Pas masuk SGC, 
                        langsung kerasa naik level tiap minggu. Pembawaannya santai tapi tetep nancep. 
                        Berasa belajar sama temen sendiri sih.”
                    </p>
                </div>

                <!-- CARD 2 -->
                <div class="group bg-white dark:bg-[#111827] p-8 rounded-2xl shadow-xl border 
                            border-gray-200 dark:border-white/10 transition-all duration-300 
                            hover:-translate-y-3 hover:shadow-2xl hover:border-pink-500/40
                            hover:dark:border-pink-400/40">

                    <img src="https://i.pravatar.cc/150?img=12"
                        class="w-20 h-20 rounded-full mx-auto mb-5 object-cover transition-all duration-300
                            group-hover:scale-110 group-hover:rotate-3" />

                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Nadia Putri
                    </h3>

                    <p class="text-pink-600 dark:text-pink-300 text-sm mb-4
                            transition-transform duration-300 group-hover:translate-y-1">
                        UI/UX Student
                    </p>

                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                        “Paling suka bagian praktiknya. Bener-bener bikin paham. 
                        Dari yang cuma bisa buka Figma doang, sekarang aku udah bisa bikin landing page lengkap. 
                        SGC tuh enak banget, ga ngantuk belajarnya.”
                    </p>
                </div>

                <!-- CARD 3 -->
                <div class="group bg-white dark:bg-[#111827] p-8 rounded-2xl shadow-xl border 
                            border-gray-200 dark:border-white/10 transition-all duration-300 
                            hover:-translate-y-3 hover:shadow-2xl hover:border-blue-500/40
                            hover:dark:border-blue-400/40">

                    <img src="https://i.pravatar.cc/150?img=32"
                        class="w-20 h-20 rounded-full mx-auto mb-5 object-cover transition-all duration-300
                            group-hover:scale-110 group-hover:rotate-3" />

                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Dimas Arya
                    </h3>

                    <p class="text-blue-600 dark:text-blue-300 text-sm mb-4
                            transition-transform duration-300 group-hover:translate-y-1">
                        Digital Marketing Student
                    </p>

                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                        “Dulu liat dashboard iklan aja pusing. Sekarang malah ketagihan ngulik. 
                        Penjelasan di SGC tuh simpel tapi dalem. Seminggu belajar udah kerasa banget bedanya.”
                    </p>
                </div>

            </div>
        </div>
    </section>


    <!-- FOOTER -->
    <footer class="relative pt-20 pb-12 bg-gray-100 dark:bg-[#0F172A] overflow-hidden">

        <!-- Glow Background Soft -->
        <div class="absolute inset-0 opacity-30 pointer-events-none">
            <div class="absolute -top-20 -left-20 w-72 h-72 bg-blue-500/40 dark:bg-blue-500/20 blur-3xl rounded-full"></div>
            <div class="absolute bottom-0 right-0 w-72 h-72 bg-purple-500/40 dark:bg-purple-500/20 blur-3xl rounded-full"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">

            <div class="grid md:grid-cols-4 gap-12">

                <!-- BRAND -->
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <img src="<?php echo e(asset('img/sgc-logo.png')); ?>" class="h-12 drop-shadow-md" />
                        <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                            Skill Grow Craft
                        </h3>
                    </div>

                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6">
                        Skill Grow Craft adalah platform pembelajaran digital yang membantu pemula
                        memahami dunia teknologi lewat materi yang terstruktur, mudah diikuti, dan ramah pemula.
                    </p>

                    <!-- SOCIAL ICONS -->
                    <div class="flex space-x-4">
                        <a class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a class="social-icon"><i class="fab fa-tiktok"></i></a>
                        <a class="social-icon"><i class="fab fa-youtube"></i></a>
                        <a class="social-icon"><i class="fab fa-github"></i></a>
                    </div>
                </div>

                <!-- TENTANG -->
                <div>
                    <h4 class="footer-title">Tentang SGC</h4>
                    <ul class="footer-list">
                        <li><a href="#">Visi & Misi</a></li>
                        <li><a href="#">Kenapa Memilih SGC?</a></li>
                        <li><a href="#">Metode Pembelajaran</a></li>
                        <li><a href="#">Komunitas Belajar</a></li>
                    </ul>
                </div>

                <!-- PROGRAM BELAJAR -->
                <div>
                    <h4 class="footer-title">Program Belajar</h4>
                    <ul class="footer-list">
                        <li><a href="#">Dasar-Dasar Website</a></li>
                        <li><a href="#">HTML & CSS Fundamental</a></li>
                        <li><a href="#">JavaScript Interaktif</a></li>
                        <li><a href="#">Mini Project & Portfolio</a></li>
                    </ul>
                </div>

            </div>

            <!-- Divider -->
            <div class="mt-16 mb-6 h-[1px] w-full bg-gradient-to-r from-transparent via-gray-400/40 dark:via-gray-700 to-transparent"></div>

            <!-- Bottom -->
            <div class="flex flex-col md:flex-row justify-between items-center text-gray-600 dark:text-gray-400">

                <p class="text-sm">
                    © 2025 Skill Grow Craft — Belajar Skill Digital Dengan Cara Yang Lebih Mudah.
                </p>

                <div class="flex space-x-6 text-sm mt-4 md:mt-0">
                    <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Privasi</a>
                    <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Legal</a>
                    <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Kontak</a>
                </div>

            </div>

        </div>
    </footer>





    
    <script>
    // Tailwind Config
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                colors: {
                    'primary': '#6366f1',
                    'primary-dark': '#4f46e5',
                    'primary-light': '#818cf8',
                    'secondary': '#ec4899',
                    'accent': '#14b8a6',
                },
                animation: {
                    'float': 'float 6s ease-in-out infinite',
                },
                keyframes: {
                    float: {
                        '0%, 100%': { transform: 'translateY(0)' },
                        '50%': { transform: 'translateY(-20px)' },
                    }
                }
            }
        }
    };

    // AOS
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,
            once: true
        });
    }

    // Custom Cursor
    const cursor = document.querySelector('.custom-cursor');
    if (cursor) {
        document.addEventListener('mousemove', e => {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
        });
        document.addEventListener('mousedown', () => cursor.classList.add('cursor-grow'));
        document.addEventListener('mouseup', () => cursor.classList.remove('cursor-grow'));
    }

    // Theme Toggle
    const themeToggleBtn = document.getElementById('theme-toggle');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');

    if (themeToggleBtn && darkIcon && lightIcon) {
        if (localStorage.getItem('color-theme') === 'dark' ||
            (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) 
        {
            document.documentElement.classList.add('dark');
            darkIcon.classList.add('hidden');
            lightIcon.classList.remove('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            darkIcon.classList.remove('hidden');
            lightIcon.classList.add('hidden');
        }

        themeToggleBtn.addEventListener('click', () => {
            darkIcon.classList.toggle('hidden');
            lightIcon.classList.toggle('hidden');

            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });
    }

    // Mobile menu
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Navbar scroll shadow
    const navbar = document.getElementById('navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('shadow-xl', window.scrollY > 50);
        });
    }

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', e => {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                e.preventDefault();
                window.scrollTo({
                    top: target.offsetTop - 100,
                    behavior: 'smooth'
                });
            }
        });
    });

    // GSAP
    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);

        gsap.from('.hero-title', { y: 50, opacity: 0, duration: 1, delay: 1.5 });
        gsap.from('.hero-subtitle', { y: 30, opacity: 0, duration: 1, delay: 1.8 });
        gsap.from('.hero-buttons', { y: 30, opacity: 0, duration: 1, delay: 2.1 });

        gsap.utils.toArray('.module-card').forEach((card, i) => {
            gsap.from(card, {
                scrollTrigger: { trigger: card, start: 'top 80%' },
                y: 50, opacity: 0, duration: 0.8, delay: i * 0.1
            });
        });

        gsap.utils.toArray('.team-card').forEach((card, i) => {
            gsap.from(card, {
                scrollTrigger: { trigger: card, start: 'top 80%' },
                y: 50, opacity: 0, duration: 0.8, delay: i * 0.1
            });
        });

        gsap.utils.toArray('.testimonial-card').forEach((card, i) => {
            gsap.from(card, {
                scrollTrigger: { trigger: card, start: 'top 80%' },
                y: 50, opacity: 0, duration: 0.8, delay: i * 0.1
            });
        });
    }

    // Particles.js
    if (typeof particlesJS !== 'undefined') {
        particlesJS('particles-js', {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: '#6366f1' },
                shape: { type: 'circle' },
                opacity: { value: 0.5 },
                size: { value: 3, random: true },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#6366f1',
                    opacity: 0.4,
                    width: 1
                },
                move: { enable: true, speed: 2 }
            },
            interactivity: {
                events: {
                    onhover: { enable: true, mode: 'grab' },
                    onclick: { enable: true, mode: 'push' }
                },
                modes: { grab: { distance: 140 } }
            },
            retina_detect: true
        });
    }
    </script>

    </body>
</html><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/landing.blade.php ENDPATH**/ ?>