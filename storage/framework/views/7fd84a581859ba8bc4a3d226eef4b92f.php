<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title><?php echo $__env->yieldContent('title', 'SGC Guru Dashboard'); ?></title>
    <link rel="shortcut icon" href="<?php echo e(asset('img/sgc-logo.png')); ?>" type="image/x-icon">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { 
            darkMode: 'class',
            theme: {
                extend: {
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 3s ease-in-out infinite',
                        'slide-in': 'slide-in 0.3s ease-out',
                        'fade-in': 'fade-in 0.5s ease-out',
                        'bounce-subtle': 'bounce-subtle 2s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-5px)' },
                        },
                        'slide-in': {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(0)' },
                        },
                        'fade-in': {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        'bounce-subtle': {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-3px)' },
                        }
                    }
                }
            }
        }
    </script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Apply saved theme before render -->
    <script>
        (function () {
            try {
                const t = localStorage.getItem('theme');
                if (t === 'dark') document.documentElement.classList.add('dark');
            } catch (e) { }
        })();
    </script>

    <style>
        * {
            transition: background-color .25s ease,
                color .25s ease,
                border-color .25s ease;
        }

        .rotate-fade {
            transition: transform .3s ease, opacity .2s ease;
        }

        .toggle-glow:hover {
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.5);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-shadow {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .card-shadow-dark {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        .nav-item {
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .nav-item:hover::before {
            left: 100%;
        }

        .active-nav {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.15) 0%, rgba(99, 102, 241, 0.05) 100%);
            border-left: 4px solid #6366f1;
        }

        .dark .active-nav {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.3) 0%, rgba(99, 102, 241, 0.1) 100%);
        }

        .profile-avatar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
            transition: all 0.3s ease;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(99, 102, 241, 0.4);
        }

        .logo-glow {
            filter: drop-shadow(0 0 8px rgba(99, 102, 241, 0.5));
        }

        .sidebar-enter {
            animation: slide-in 0.3s ease-out;
        }

        .content-fade {
            animation: fade-in 0.5s ease-out;
        }

        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.1);
        }

        .dark .hover-lift:hover {
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.3);
        }

        .logout-btn {
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%);
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(244, 63, 94, 0.3);
        }

        .theme-btn {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            transition: all 0.3s ease;
        }

        .theme-btn:hover {
            background: linear-gradient(135deg, #475569 0%, #334155 100%);
            transform: translateY(-2px);
        }

        .dark .theme-btn {
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
        }

        .dark .theme-btn:hover {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        }

        .mobile-nav-bg {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }

        .dark .mobile-nav-bg {
            background: rgba(31, 41, 55, 0.9);
        }

        .sidebar-bg {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%);
            backdrop-filter: blur(10px);
        }

        .dark .sidebar-bg {
            background: linear-gradient(180deg, rgba(31, 41, 55, 0.95) 0%, rgba(31, 41, 55, 0.85) 100%);
        }

        .content-bg {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .dark .content-bg {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }

        .pulse-dot {
            animation: pulse-slow 2s infinite;
        }
    </style>
</head>

<body class="content-bg dark:text-gray-100 min-h-screen">


    <!-- MOBILE NAVBAR -->
    <div class="lg:hidden fixed top-0 left-0 w-full px-4 py-3 mobile-nav-bg shadow-lg flex items-center justify-between z-40 animate-fade-in">
        <button id="openSidebar"
            class="p-2 rounded-lg hover-lift bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 shadow-md">
            <i class="fas fa-bars"></i>
        </button>

        <h1 class="font-bold text-xl text-transparent bg-clip-text gradient-bg">SGC Guru</h1>

        <div class="profile-avatar w-10 h-10 rounded-full text-white flex items-center justify-center font-bold">
            <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

        </div>
    </div>

    <div class="h-16 lg:hidden"></div>

    <div class="flex min-h-screen">

        <!-- SIDEBAR DESKTOP -->
        <aside class="hidden lg:flex w-72 flex-col sidebar-bg dark:bg-gray-800 p-6 border-r dark:border-gray-700 card-shadow dark:card-shadow-dark sidebar-enter">

            <!-- Logo -->
            <div class="flex items-center gap-3 mb-8 animate-fade-in">
                <div class="relative">
                    <img src="<?php echo e(asset('img/sgc-logo.png')); ?>" class="w-12 h-12 rounded-lg shadow-lg logo-glow">
                </div>
                <div>
                    <h2 class="font-bold text-xl text-transparent bg-clip-text gradient-bg">SGC</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Guru Panel</p>
                </div>
            </div>

            <nav class="space-y-2">

                <a href="<?php echo e(route('guru.dashboard')); ?>"
                    class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl hover-lift
                    text-gray-700 dark:text-gray-300
                    <?php echo e(request()->routeIs('guru.dashboard') ? 'active-nav text-indigo-600 font-semibold' : ''); ?>">
                    <i class="fas fa-home w-5"></i> Dashboard
                </a>

                <a href="<?php echo e(route('guru.modul.index')); ?>"
                    class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl hover-lift
                    text-gray-700 dark:text-gray-300
                    <?php echo e(request()->routeIs('guru.modul.*') ? 'active-nav text-indigo-600 font-semibold' : ''); ?>">
                    <i class="fas fa-book w-5"></i> Kelola Modul
                </a>

                <a href="<?php echo e(route('guru.murid.index')); ?>"
                    class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl hover-lift
                    text-gray-700 dark:text-gray-300">
                    <i class="fas fa-users w-5"></i> Murid Binaan
                </a>

                <a href="<?php echo e(route('guru.profile.edit')); ?>"
                    class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl hover-lift
                    text-gray-700 dark:text-gray-300
                    <?php echo e(request()->routeIs('guru.profile.edit') ? 'active-nav text-indigo-600 font-semibold' : ''); ?>">
                    <i class="fas fa-user-cog w-5"></i> Profil
                </a>

                <!-- Theme Switch -->
                <button id="toggleTheme"
                    class="toggle-glow w-full flex items-center gap-3 px-4 py-3 mt-2
                    rounded-xl theme-btn text-white">
                    <i id="themeIcon" class="rotate-fade fas fa-moon w-5"></i>
                    <span id="themeLabel">Dark Mode</span>
                </button>

                <!-- Logout -->
                <form action="<?php echo e(route('logout')); ?>" method="POST" class="mt-4">
                    <?php echo csrf_field(); ?>
                    <button class="logout-btn w-full flex items-center gap-3 px-4 py-3 text-white rounded-xl">
                        <i class="fas fa-sign-out-alt w-5"></i> Logout
                    </button>
                </form>

            </nav>

        </aside>



        <!-- SIDEBAR MOBILE DRAWER -->
        <aside id="mobileSidebar"
            class="fixed top-0 left-0 w-64 h-full sidebar-bg dark:bg-gray-800 shadow-2xl transform -translate-x-full transition-all duration-300 z-50 p-6 lg:hidden">

            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <img src="<?php echo e(asset('img/sgc-logo.png')); ?>" class="w-10 h-10 rounded-lg shadow-lg logo-glow">
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-transparent bg-clip-text gradient-bg">SGC</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Guru Panel</p>
                    </div>
                </div>

                <button id="closeSidebar"
                    class="p-2 rounded-lg hover-lift bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 shadow-md">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <nav class="space-y-2">

                <a href="<?php echo e(route('guru.dashboard')); ?>"
                    class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl hover-lift
                    <?php echo e(request()->routeIs('guru.dashboard') ? 'active-nav text-indigo-600 font-semibold' : ''); ?>">
                    <i class="fas fa-home w-5"></i> Dashboard
                </a>

                <a href="<?php echo e(route('guru.modul.index')); ?>"
                    class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl hover-lift
                    <?php echo e(request()->routeIs('guru.modul.*') ? 'active-nav text-indigo-600 font-semibold' : ''); ?>">
                    <i class="fas fa-book w-5"></i> Kelola Modul
                </a>

                <a href="<?php echo e(route('guru.murid.index')); ?>" 
                class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl hover-lift">
                    <i class="fas fa-users w-5"></i> Murid Binaan
                </a>


                <a href="<?php echo e(route('guru.profile.edit')); ?>"
                    class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl hover-lift
                    <?php echo e(request()->routeIs('guru.profile.edit') ? 'active-nav text-indigo-600 font-semibold' : ''); ?>">
                    <i class="fas fa-user-cog w-5"></i> Profil
                </a>

                <button id="toggleThemeMobile"
                    class="toggle-glow w-full flex items-center gap-3 px-4 py-3 mt-2
                    rounded-xl theme-btn text-white">
                    <i id="themeIconMobile" class="rotate-fade fas fa-moon w-5"></i>
                    <span id="themeLabelMobile">Dark Mode</span>
                </button>

                <!-- LOGOUT (MOBILE) -->
                <form action="<?php echo e(route('logout')); ?>" method="POST" class="mt-4">
                    <?php echo csrf_field(); ?>
                    <button class="logout-btn w-full flex items-center gap-3 px-4 py-3 text-white rounded-xl">
                        <i class="fas fa-sign-out-alt w-5"></i> Logout
                    </button>
                </form>


            </nav>
        </aside>

        <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 hidden z-40 lg:hidden"></div>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 lg:p-8 content-fade">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

    </div>

    <!-- SCRIPT THEME SWITCH + MOBILE SIDEBAR -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            /* SIDEBAR MOBILE */
            const openBtn = document.getElementById("openSidebar");
            const closeBtn = document.getElementById("closeSidebar");
            const sidebar = document.getElementById("mobileSidebar");
            const overlay = document.getElementById("sidebarOverlay");

            function open() {
                sidebar.classList.remove("-translate-x-full");
                overlay.classList.remove("hidden");
                document.body.style.overflow = "hidden";
            }

            function close() {
                sidebar.classList.add("-translate-x-full");
                overlay.classList.add("hidden");
                document.body.style.overflow = "";
            }

            if (openBtn) openBtn.onclick = open;
            if (closeBtn) closeBtn.onclick = close;
            if (overlay) overlay.onclick = close;


            /* THEME SWITCH */
            const desktopBtn = document.getElementById("toggleTheme");
            const mobileBtn = document.getElementById("toggleThemeMobile");

            const icon = document.getElementById("themeIcon");
            const iconM = document.getElementById("themeIconMobile");

            const label = document.getElementById("themeLabel");
            const labelM = document.getElementById("themeLabelMobile");

            function updateUI() {
                const dark = document.documentElement.classList.contains("dark");

                icon.className = dark ? "rotate-fade fas fa-sun w-5" : "rotate-fade fas fa-moon w-5";
                iconM.className = dark ? "rotate-fade fas fa-sun w-5" : "rotate-fade fas fa-moon w-5";

                label.textContent = dark ? "Light Mode" : "Dark Mode";
                labelM.textContent = dark ? "Light Mode" : "Dark Mode";
            }

            function toggleTheme() {
                const dark = document.documentElement.classList.toggle("dark");
                localStorage.setItem("theme", dark ? "dark" : "light");
                updateUI();
            }

            if (desktopBtn) desktopBtn.onclick = toggleTheme;
            if (mobileBtn) mobileBtn.onclick = toggleTheme;

            updateUI();

            // Add subtle animations to elements on page load
            const elements = document.querySelectorAll('.nav-item, .profile-avatar, .logo-glow');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(10px)';
                setTimeout(() => {
                    el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
    </script>

</body>

</html><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/layouts/guru.blade.php ENDPATH**/ ?>