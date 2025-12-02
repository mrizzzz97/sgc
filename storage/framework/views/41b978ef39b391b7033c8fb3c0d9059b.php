<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FrontEndClass - Jadi Front-End Developer dari Nol</title>
    
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
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --secondary: #ec4899;
            --accent: #14b8a6;
        }
        
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
        
        /* Loading screen */
        .loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        
        .loader {
            position: relative;
            width: 150px;
            height: 150px;
        }
        
        .loader-circle {
            position: absolute;
            border-radius: 50%;
            border: 3px solid transparent;
        }
        
        .loader-circle-1 {
            width: 150px;
            height: 150px;
            border-top-color: var(--primary);
            animation: rotate1 2s linear infinite;
        }
        
        .loader-circle-2 {
            width: 120px;
            height: 120px;
            top: 15px;
            left: 15px;
            border-right-color: var(--secondary);
            animation: rotate2 2s linear infinite;
        }
        
        .loader-circle-3 {
            width: 90px;
            height: 90px;
            top: 30px;
            left: 30px;
            border-bottom-color: var(--accent);
            animation: rotate3 2s linear infinite;
        }
        
        .loader-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-weight: bold;
            font-size: 18px;
            color: var(--primary);
        }
        
        @keyframes rotate1 {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes rotate2 {
            0% { transform: rotate(120deg); }
            100% { transform: rotate(480deg); }
        }
        
        @keyframes rotate3 {
            0% { transform: rotate(240deg); }
            100% { transform: rotate(600deg); }
        }
        
        /* Floating header */
        .floating-header {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        /* Navbar background blur effect */
        .navbar-blur {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        /* Glowing effect */
        .glow {
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.5);
        }
        
        .glow-on-hover:hover {
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.7);
        }
        
        /* Gradient text */
        .gradient-text {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        /* Animated background */
        .animated-bg {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }
        
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Card hover effects */
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-10px);
        }
        
        /* Module card animation */
        .module-card {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .module-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .module-card:hover::before {
            left: 100%;
        }
        
        /* Team member card */
        .team-card {
            perspective: 1000px;
        }
        
        .team-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }
        
        .team-card:hover .team-card-inner {
            transform: rotateY(180deg);
        }
        
        .team-card-front, .team-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            border-radius: 1rem;
            overflow: hidden;
        }
        
        .team-card-back {
            transform: rotateY(180deg);
        }
        
        /* Custom cursor */
        .custom-cursor {
            width: 20px;
            height: 20px;
            border: 2px solid var(--primary);
            border-radius: 50%;
            position: fixed;
            transform: translate(-50%, -50%);
            pointer-events: none;
            transition: all 0.1s ease;
            z-index: 9998;
            mix-blend-mode: difference;
        }
        
        .cursor-grow {
            transform: translate(-50%, -50%) scale(1.5);
            background-color: rgba(99, 102, 241, 0.5);
        }
        
        /* Particle background */
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
        }
        
        /* Blob animation */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.7;
            animation: blob 7s infinite;
        }
        
        .blob-1 {
            background: rgba(99, 102, 241, 0.5);
            width: 300px;
            height: 300px;
            top: -150px;
            right: -100px;
            animation-delay: 0s;
        }
        
        .blob-2 {
            background: rgba(236, 72, 153, 0.5);
            width: 250px;
            height: 250px;
            bottom: -100px;
            left: -100px;
            animation-delay: 2s;
        }
        
        .blob-3 {
            background: rgba(20, 184, 166, 0.5);
            width: 200px;
            height: 200px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: 4s;
        }
        
        @keyframes blob {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }
        
        /* Progress bar animation */
        .progress-bar {
            position: relative;
            height: 6px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
            overflow: hidden;
        }
        
        .progress-fill {
            position: absolute;
            height: 100%;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border-radius: 3px;
            animation: progressAnimation 2s ease-in-out;
        }
        
        @keyframes progressAnimation {
            0% { width: 0; }
        }
        
        /* Button animation */
        .btn-animated {
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-animated::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: -1;
        }
        
        .btn-animated:hover::before {
            transform: translateX(0);
        }
        
        /* Floating elements */
        .float-element {
            animation: float 6s ease-in-out infinite;
        }
        
        .float-element-delay-1 {
            animation-delay: 1s;
        }
        
        .float-element-delay-2 {
            animation-delay: 2s;
        }
        
        .float-element-delay-3 {
            animation-delay: 3s;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .blob {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased transition-colors duration-300 overflow-x-hidden">
    <!-- Custom Cursor -->
    <div class="custom-cursor"></div>
    
    <!-- Loading Screen -->
    <div class="loader-wrapper">
        <div class="loader">
            <div class="loader-circle loader-circle-1"></div>
            <div class="loader-circle loader-circle-2"></div>
            <div class="loader-circle loader-circle-3"></div>
            <div class="loader-text">FEC</div>
        </div>
    </div>
    
    <!-- NAVBAR -->
    <nav class="fixed top-0 left-0 w-full z-50 transition-all duration-300 navbar-blur" id="navbar">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="floating-header">
                        <h1 class="text-2xl font-bold gradient-text">FrontEndClass</h1>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#materi" class="nav-link relative group">
                        <span class="font-medium">Materi</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-secondary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#kelas" class="nav-link relative group">
                        <span class="font-medium">Kelas</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-secondary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#tim" class="nav-link relative group">
                        <span class="font-medium">Tim Kami</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-secondary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- Dark Mode Toggle -->
                    <button id="theme-toggle" type="button" class="p-2 rounded-lg transition-colors">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                    </button>
                    
                    <?php if(auth()->guard()->check()): ?>
                        <a href="/dashboard" class="px-5 py-2.5 bg-gradient-to-r from-primary to-secondary text-white rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-lg">
                            Dashboard
                        </a>
                    <?php else: ?>
                        <a href="/login" class="px-5 py-2.5 border border-primary text-primary dark:text-primary-light dark:border-primary-light rounded-lg font-medium transition-all duration-200">
                            Login
                        </a>
                        <a href="/register" class="px-5 py-2.5 bg-gradient-to-r from-primary to-secondary text-white rounded-lg font-medium transition-all duration-200 transform hover:scale-105 shadow-lg">
                            Register
                        </a>
                    <?php endif; ?>
                    
                    <!-- Mobile menu button -->
                    <button class="md:hidden" id="mobileMenuBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile menu -->
            <div class="hidden md:hidden mt-4 pb-4" id="mobileMenu">
                <a href="#materi" class="block py-2 font-medium">Materi</a>
                <a href="#kelas" class="block py-2 font-medium">Kelas</a>
                <a href="#tim" class="block py-2 font-medium">Tim Kami</a>
            </div>
        </div>
    </nav>
    
    <!-- HERO -->
    <section class="min-h-screen flex items-center justify-center relative pt-20">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>
            <div id="particles-js"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="order-2 md:order-1">
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary-light text-sm font-medium mb-6">
                        <span class="w-2 h-2 bg-primary dark:bg-primary-light rounded-full mr-2 animate-pulse"></span>
                        Belajar Front-End dari Ahlinya
                    </div>
                    
                    <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                        Jadi Front-End Developer,<br>
                        <span class="gradient-text">Mulai dari Nol!</span>
                    </h1>
                    
                    <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
                        Belajar HTML, CSS, JavaScript, dan Framework modern dengan metode yang gampang dipahami.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 mb-12">
                        <a href="#materi" class="btn-animated px-7 py-3.5 bg-gradient-to-r from-primary to-secondary text-white rounded-lg font-medium text-center transition-all duration-200 transform hover:scale-105 shadow-lg">
                            Mulai Belajar
                        </a>
                        <a href="#materi" class="px-7 py-3.5 border border-primary text-primary dark:text-primary-light dark:border-primary-light rounded-lg font-medium text-center transition-all duration-200">
                            Lihat Materi
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold gradient-text">10K+</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Siswa Aktif</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold gradient-text">50+</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Materi Pembelajaran</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold gradient-text">95%</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Tingkat Kepuasan</div>
                        </div>
                    </div>
                </div>
                
                <div class="order-1 md:order-2 flex justify-center">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-tr from-primary to-secondary opacity-20 dark:opacity-10 rounded-3xl blur-2xl transform rotate-6"></div>
                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/frontend-developer-illustration-download-in-svg-png-gif-file-formats--development-team-coding-pack-illustrations-6505574.png"
                             class="relative w-full max-w-md drop-shadow-2xl transform hover:scale-105 transition-transform duration-500 float-element">
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- MATERI -->
    <section id="materi" class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Materi <span class="gradient-text">Front-End</span></h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Dasar kuat, skill naik cepat. Materi dirancang oleh praktisi industri dengan pengalaman bertahun-tahun.</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-5 gap-6">
                <!-- Module 1 -->
                <div class="module-card bg-white dark:bg-gray-900 rounded-xl shadow-md hover:shadow-xl p-6 card-hover" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-3xl mb-4">🏗️</div>
                    <h3 class="text-lg font-semibold mb-2">Modul 1</h3>
                    <p class="font-medium gradient-text">Kenalan Dengan Website</p>
                    <div class="mt-4 progress-bar">
                        <div class="progress-fill" style="width: 100%"></div>
                    </div>
                </div>
                
                <!-- Module 2 -->
                <div class="module-card bg-white dark:bg-gray-900 rounded-xl shadow-md hover:shadow-xl p-6 card-hover" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-3xl mb-4">📄</div>
                    <h3 class="text-lg font-semibold mb-2">Modul 2</h3>
                    <p class="font-medium gradient-text">HTML Dasar</p>
                    <div class="mt-4 progress-bar">
                        <div class="progress-fill" style="width: 90%"></div>
                    </div>
                </div>
                
                <!-- Module 3 -->
                <div class="module-card bg-white dark:bg-gray-900 rounded-xl shadow-md hover:shadow-xl p-6 card-hover" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-3xl mb-4">🎨</div>
                    <h3 class="text-lg font-semibold mb-2">Modul 3</h3>
                    <p class="font-medium gradient-text">CSS Dasar</p>
                    <div class="mt-4 progress-bar">
                        <div class="progress-fill" style="width: 80%"></div>
                    </div>
                </div>
                
                <!-- Module 4 -->
                <div class="module-card bg-white dark:bg-gray-900 rounded-xl shadow-md hover:shadow-xl p-6 card-hover" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-3xl mb-4">📐</div>
                    <h3 class="text-lg font-semibold mb-2">Modul 4</h3>
                    <p class="font-medium gradient-text">Layout Dasar</p>
                    <div class="mt-4 progress-bar">
                        <div class="progress-fill" style="width: 70%"></div>
                    </div>
                </div>
                
                <!-- Module 5 -->
                <div class="module-card bg-white dark:bg-gray-900 rounded-xl shadow-md hover:shadow-xl p-6 card-hover" data-aos="fade-up" data-aos-delay="500">
                    <div class="text-3xl mb-4">📱</div>
                    <h3 class="text-lg font-semibold mb-2">Modul 5</h3>
                    <p class="font-medium gradient-text">Responsive Dasar</p>
                    <div class="mt-4 progress-bar">
                        <div class="progress-fill" style="width: 60%"></div>
                    </div>
                </div>
                
                <!-- Module 6 -->
                <div class="module-card bg-white dark:bg-gray-900 rounded-xl shadow-md hover:shadow-xl p-6 card-hover" data-aos="fade-up" data-aos-delay="600">
                    <div class="text-3xl mb-4">⚙️</div>
                    <h3 class="text-lg font-semibold mb-2">Modul 6</h3>
                    <p class="font-medium gradient-text">JavaScript Dasar Banget</p>
                    <div class="mt-4 progress-bar">
                        <div class="progress-fill" style="width: 50%"></div>
                    </div>
                </div>
                
                <!-- Module 7 -->
                <div class="module-card bg-white dark:bg-gray-900 rounded-xl shadow-md hover:shadow-xl p-6 card-hover" data-aos="fade-up" data-aos-delay="700">
                    <div class="text-3xl mb-4">🎮</div>
                    <h3 class="text-lg font-semibold mb-2">Modul 7</h3>
                    <p class="font-medium gradient-text">JavaScript Interaktif</p>
                    <div class="mt-4 progress-bar">
                        <div class="progress-fill" style="width: 40%"></div>
                    </div>
                </div>
                
                <!-- Module 8 -->
                <div class="module-card bg-white dark:bg-gray-900 rounded-xl shadow-md hover:shadow-xl p-6 card-hover" data-aos="fade-up" data-aos-delay="800">
                    <div class="text-3xl mb-4">🔧</div>
                    <h3 class="text-lg font-semibold mb-2">Modul 8</h3>
                    <p class="font-medium gradient-text">Git Pemula</p>
                    <div class="mt-4 progress-bar">
                        <div class="progress-fill" style="width: 30%"></div>
                    </div>
                </div>
                
                <!-- Module 9 -->
                <div class="module-card bg-white dark:bg-gray-900 rounded-xl shadow-md hover:shadow-xl p-6 card-hover" data-aos="fade-up" data-aos-delay="900">
                    <div class="text-3xl mb-4">🚀</div>
                    <h3 class="text-lg font-semibold mb-2">Modul 9</h3>
                    <p class="font-medium gradient-text">CSS Framework Dasar</p>
                    <div class="mt-4 progress-bar">
                        <div class="progress-fill" style="width: 20%"></div>
                    </div>
                </div>
                
                <!-- Module 10 -->
                <div class="module-card bg-white dark:bg-gray-900 rounded-xl shadow-md hover:shadow-xl p-6 card-hover" data-aos="fade-up" data-aos-delay="1000">
                    <div class="text-3xl mb-4">🏆</div>
                    <h3 class="text-lg font-semibold mb-2">Modul 10</h3>
                    <p class="font-medium gradient-text">Mini Project Pemula</p>
                    <div class="mt-4 progress-bar">
                        <div class="progress-fill" style="width: 10%"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- KELAS -->
    <section id="kelas" class="py-20 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Kelas <span class="gradient-text">Unggulan</span></h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Dipandu step-by-step biar makin paham. Dapatkan sertifikat setelah menyelesaikan kelas.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Kelas 1 -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-2 bg-gradient-to-r from-primary to-secondary"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                Pemula
                            </span>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                4 minggu
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Front-End Dasar</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Belajar HTML, CSS, JavaScript dari nol.</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex -space-x-2">
                                    <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://picsum.photos/seed/user1/100/100.jpg" alt="">
                                    <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://picsum.photos/seed/user2/100/100.jpg" alt="">
                                    <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://picsum.photos/seed/user3/100/100.jpg" alt="">
                                </div>
                                <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">150+ siswa</span>
                            </div>
                            <a href="#" class="text-primary dark:text-primary-light font-medium text-sm hover:underline">Daftar →</a>
                        </div>
                    </div>
                </div>
                
                <!-- Kelas 2 -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="h-2 bg-gradient-to-r from-primary to-secondary"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                Menengah
                            </span>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                3 minggu
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Tailwind Mastery</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Bikin UI modern dengan cepat.</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex -space-x-2">
                                    <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://picsum.photos/seed/user4/100/100.jpg" alt="">
                                    <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://picsum.photos/seed/user5/100/100.jpg" alt="">
                                    <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://picsum.photos/seed/user6/100/100.jpg" alt="">
                                </div>
                                <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">120+ siswa</span>
                            </div>
                            <a href="#" class="text-primary dark:text-primary-light font-medium text-sm hover:underline">Daftar →</a>
                        </div>
                    </div>
                </div>
                
                <!-- Kelas 3 -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="h-2 bg-gradient-to-r from-primary to-secondary"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                Lanjutan
                            </span>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                5 minggu
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">JavaScript Intensive</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Latihan logika & mini project.</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex -space-x-2">
                                    <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://picsum.photos/seed/user7/100/100.jpg" alt="">
                                    <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://picsum.photos/seed/user8/100/100.jpg" alt="">
                                    <img class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-800" src="https://picsum.photos/seed/user9/100/100.jpg" alt="">
                                </div>
                                <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">100+ siswa</span>
                            </div>
                            <a href="#" class="text-primary dark:text-primary-light font-medium text-sm hover:underline">Daftar →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- TIM KAMI -->
    <section id="tim" class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Tim <span class="gradient-text">Kami</span></h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Tim profesional dengan pengalaman bertahun-tahun di industri teknologi.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Team Member 1 -->
                <div class="team-card h-96" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-card-inner">
                        <div class="team-card-front bg-white dark:bg-gray-900 rounded-xl shadow-lg p-6 flex flex-col items-center justify-center">
                            <img src="https://picsum.photos/seed/team1/300/300.jpg" alt="Ahmad Fauzi" class="w-32 h-32 rounded-full mb-4">
                            <h3 class="text-xl font-bold mb-1">Ahmad Fauzi</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Full-Stack Developer</p>
                            <div class="flex space-x-3">
                                <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary-light">
                                    <i class="fab fa-linkedin text-xl"></i>
                                </a>
                                <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary-light">
                                    <i class="fab fa-github text-xl"></i>
                                </a>
                                <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary-light">
                                    <i class="fab fa-twitter text-xl"></i>
                                </a>
                            </div>
                        </div>
                        <div class="team-card-back bg-gradient-to-br from-primary to-secondary rounded-xl shadow-lg p-6 flex flex-col items-center justify-center text-white">
                            <p class="text-center mb-4">Pengalaman 8+ tahun di bidang web development. Spesialisasi dalam React, Node.js, dan cloud architecture.</p>
                            <div class="flex space-x-3">
                                <a href="#" class="text-white hover:text-gray-200">
                                    <i class="fab fa-linkedin text-xl"></i>
                                </a>
                                <a href="#" class="text-white hover:text-gray-200">
                                    <i class="fab fa-github text-xl"></i>
                                </a>
                                <a href="#" class="text-white hover:text-gray-200">
                                    <i class="fab fa-twitter text-xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 2 -->
                <div class="team-card h-96" data-aos="fade-up" data-aos-delay="200">
                    <div class="team-card-inner">
                        <div class="team-card-front bg-white dark:bg-gray-900 rounded-xl shadow-lg p-6 flex flex-col items-center justify-center">
                            <img src="https://picsum.photos/seed/team2/300/300.jpg" alt="Siti Nurhaliza" class="w-32 h-32 rounded-full mb-4">
                            <h3 class="text-xl font-bold mb-1">Siti Nurhaliza</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Full-Stack Developer</p>
                            <div class="flex space-x-3">
                                <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary-light">
                                    <i class="fab fa-linkedin text-xl"></i>
                                </a>
                                <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary-light">
                                    <i class="fab fa-github text-xl"></i>
                                </a>
                                <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary-light">
                                    <i class="fab fa-twitter text-xl"></i>
                                </a>
                            </div>
                        </div>
                        <div class="team-card-back bg-gradient-to-br from-primary to-secondary rounded-xl shadow-lg p-6 flex flex-col items-center justify-center text-white">
                            <p class="text-center mb-4">Pengalaman 6+ tahun di bidang web development. Spesialisasi dalam Vue.js, PHP, dan UI/UX design.</p>
                            <div class="flex space-x-3">
                                <a href="#" class="text-white hover:text-gray-200">
                                    <i class="fab fa-linkedin text-xl"></i>
                                </a>
                                <a href="#" class="text-white hover:text-gray-200">
                                    <i class="fab fa-github text-xl"></i>
                                </a>
                                <a href="#" class="text-white hover:text-gray-200">
                                    <i class="fab fa-twitter text-xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 3 -->
                <div class="team-card h-96" data-aos="fade-up" data-aos-delay="300">
                    <div class="team-card-inner">
                        <div class="team-card-front bg-white dark:bg-gray-900 rounded-xl shadow-lg p-6 flex flex-col items-center justify-center">
                            <img src="https://picsum.photos/seed/team3/300/300.jpg" alt="Budi Santoso" class="w-32 h-32 rounded-full mb-4">
                            <h3 class="text-xl font-bold mb-1">Budi Santoso</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Full-Stack Developer</p>
                            <div class="flex space-x-3">
                                <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary-light">
                                    <i class="fab fa-linkedin text-xl"></i>
                                </a>
                                <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary-light">
                                    <i class="fab fa-github text-xl"></i>
                                </a>
                                <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary-light">
                                    <i class="fab fa-twitter text-xl"></i>
                                </a>
                            </div>
                        </div>
                        <div class="team-card-back bg-gradient-to-br from-primary to-secondary rounded-xl shadow-lg p-6 flex flex-col items-center justify-center text-white">
                            <p class="text-center mb-4">Pengalaman 7+ tahun di bidang web development. Spesialisasi dalam Angular, Python, dan DevOps.</p>
                            <div class="flex space-x-3">
                                <a href="#" class="text-white hover:text-gray-200">
                                    <i class="fab fa-linkedin text-xl"></i>
                                </a>
                                <a href="#" class="text-white hover:text-gray-200">
                                    <i class="fab fa-github text-xl"></i>
                                </a>
                                <a href="#" class="text-white hover:text-gray-200">
                                    <i class="fab fa-twitter text-xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- TESTIMONIALS -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Apa Kata <span class="gradient-text">Mereka</span></h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Dengar langsung dari alumni yang telah berhasil memulai karir sebagai Front-End Developer.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl" data-aos="fade-up" data-aos-delay="100">
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
                
                <!-- Testimonial 2 -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl" data-aos="fade-up" data-aos-delay="200">
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
                
                <!-- Testimonial 3 -->
                <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl" data-aos="fade-up" data-aos-delay="300">
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
    
    <!-- CTA -->
    <section class="py-20 bg-gradient-to-r from-primary to-secondary">
        <div class="container mx-auto px-6 text-center">
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
    
    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-400 py-16">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <div>
                    <h3 class="text-2xl font-bold text-white mb-4">FrontEndClass</h3>
                    <p class="text-gray-500 mb-4">Platform pembelajaran Front-End Development terbaik untuk memulai karir di dunia teknologi.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Platform</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Karir</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Partner</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Kelas</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition-colors">Front-End Dasar</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">JavaScript Intensive</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">React Mastery</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Vue.js Fundamental</a></li>
                    </ul>
                </div>
                
                <div>
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
        // Konfigurasi Tailwind untuk Dark Mode
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
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
        
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true
        });
        
        // Custom cursor
        const cursor = document.querySelector('.custom-cursor');
        
        document.addEventListener('mousemove', (e) => {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
        });
        
        document.addEventListener('mousedown', () => {
            cursor.classList.add('cursor-grow');
        });
        
        document.addEventListener('mouseup', () => {
            cursor.classList.remove('cursor-grow');
        });
        
        // Loading screen
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.querySelector('.loader-wrapper').style.display = 'none';
            }, 1500);
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
                navbar.classList.add('shadow-lg', 'bg-white/90', 'dark:bg-gray-900/90');
            } else {
                navbar.classList.remove('shadow-lg', 'bg-white/90', 'dark:bg-gray-900/90');
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
        
        // GSAP Animations
        gsap.registerPlugin(ScrollTrigger);
        
        // Hero animation
        gsap.from('.hero-title', {
            y: 50,
            opacity: 0,
            duration: 1,
            delay: 1.5
        });
        
        gsap.from('.hero-subtitle', {
            y: 30,
            opacity: 0,
            duration: 1,
            delay: 1.8
        });
        
        gsap.from('.hero-buttons', {
            y: 30,
            opacity: 0,
            duration: 1,
            delay: 2.1
        });
        
        // Module cards animation
        gsap.utils.toArray('.module-card').forEach((card, index) => {
            gsap.from(card, {
                scrollTrigger: {
                    trigger: card,
                    start: 'top 80%',
                    toggleActions: 'play none none none'
                },
                y: 50,
                opacity: 0,
                duration: 0.8,
                delay: index * 0.1
            });
        });
        
        // Team cards animation
        gsap.utils.toArray('.team-card').forEach((card, index) => {
            gsap.from(card, {
                scrollTrigger: {
                    trigger: card,
                    start: 'top 80%',
                    toggleActions: 'play none none none'
                },
                y: 50,
                opacity: 0,
                duration: 0.8,
                delay: index * 0.1
            });
        });
        
        // Testimonial cards animation
        gsap.utils.toArray('.testimonial-card').forEach((card, index) => {
            gsap.from(card, {
                scrollTrigger: {
                    trigger: card,
                    start: 'top 80%',
                    toggleActions: 'play none none none'
                },
                y: 50,
                opacity: 0,
                duration: 0.8,
                delay: index * 0.1
            });
        });
        
        // Floating animation for elements
        gsap.utils.toArray('.float-element').forEach(element => {
            gsap.to(element, {
                y: -20,
                duration: 2,
                ease: 'power1.inOut',
                repeat: -1,
                yoyo: true
            });
        });
    </script>
</body>
</html><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/landing.blade.php ENDPATH**/ ?>