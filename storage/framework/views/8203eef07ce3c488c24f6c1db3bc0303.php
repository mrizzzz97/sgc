<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?> - Admin Panel</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    <!-- Animations -->
    <style>
        .content-fade-in {
            animation: fadeIn .4s ease-out;
        }
        @keyframes fadeIn {
            from {opacity:0; transform:translateY(10px);}
            to {opacity:1; transform:translateY(0);}
        }

        * {
            transition: background-color .25s,
                        color .25s,
                        border-color .25s;
        }

        /* Toggle Button Styles */
        .theme-toggle-container {
            position: relative;
            width: 100%;
            height: 48px;
            overflow: hidden;
        }

        .theme-toggle-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 8px;
            background-color: #1f2937;
            transition: all 0.3s ease;
        }

        .light-mode .theme-toggle-bg {
            background-color: #f3f4f6;
        }

        .theme-toggle-slider {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
            box-sizing: border-box;
        }

        .theme-icon {
            position: relative;
            width: 24px;
            height: 24px;
            z-index: 2;
        }

        .sun-icon, .moon-icon {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transition: all 0.3s ease;
        }

        .sun-icon {
            opacity: 1;
            transform: rotate(0deg) scale(1);
        }

        .moon-icon {
            opacity: 0;
            transform: rotate(90deg) scale(0.8);
        }

        .light-mode .sun-icon {
            opacity: 0;
            transform: rotate(-90deg) scale(0.8);
        }

        .light-mode .moon-icon {
            opacity: 1;
            transform: rotate(0deg) scale(1);
        }

        .theme-label {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-weight: 600;
            transition: all 0.3s ease;
            z-index: 1;
        }

        .light-mode .theme-label {
            color: #1f2937;
        }

        .dark-mode .theme-label {
            color: #f3f4f6;
        }

        /* Sun rays animation */
        .sun-rays {
            animation: rotate 20s linear infinite;
            transform-origin: center;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Moon craters animation */
        .moon-crater {
            animation: craterPulse 4s ease-in-out infinite alternate;
        }

        @keyframes craterPulse {
            0% { opacity: 0.6; }
            100% { opacity: 1; }
        }
    </style>
</head>

<!-- BODY (LIGHT MODE DEFAULT) -->
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white h-screen overflow-hidden">

<div class="flex h-full">
    <!-- SIDEBAR -->
    <aside id="sidebar"
           class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700
                  transform -translate-x-full lg:translate-x-0 lg:static
                  transition-transform duration-300">

        <div class="flex flex-col h-full">

            <!-- HEADER -->
            <div class="flex items-center justify-between h-16 px-6 bg-gray-100 dark:bg-gray-900 shadow">
                <h1 class="font-bold text-xl text-indigo-600 dark:text-indigo-400">Admin Panel</h1>

                <button id="close-sidebar-btn" class="lg:hidden text-gray-500 dark:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- NAV -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="<?php echo e(route('admin.dashboard')); ?>"
                   class="flex items-center px-4 py-3 rounded-lg
                          text-gray-700 dark:text-gray-200
                          hover:bg-gray-200 dark:hover:bg-gray-700
                          transition">
                    <svg class="w-5 h-5 mr-3 text-gray-500 dark:text-gray-400"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <!-- DARK MODE TOGGLE WITH ANIMATION -->
                <div class="px-4 py-2">
                    <button id="theme-toggle" class="theme-toggle-container dark-mode">
                        <div class="theme-toggle-bg"></div>
                        <div class="theme-toggle-slider">
                            <div class="theme-icon">
                                <!-- Sun Icon -->
                                <svg class="sun-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="5" fill="#FCD34D"/>
                                    <g class="sun-rays">
                                        <path d="M12 1V3" stroke="#FCD34D" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M12 21V23" stroke="#FCD34D" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M4.22 4.22L5.64 5.64" stroke="#FCD34D" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M18.36 18.36L19.78 19.78" stroke="#FCD34D" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M1 12H3" stroke="#FCD34D" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M21 12H23" stroke="#FCD34D" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M4.22 19.78L5.64 18.36" stroke="#FCD34D" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M18.36 5.64L19.78 4.22" stroke="#FCD34D" stroke-width="2" stroke-linecap="round"/>
                                    </g>
                                </svg>
                                <!-- Moon Icon -->
                                <svg class="moon-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" fill="#E0E7FF"/>
                                    <g class="moon-crater">
                                        <circle cx="9" cy="13" r="1.5" fill="#C7D2FE" opacity="0.6"/>
                                        <circle cx="14.5" cy="10" r="1" fill="#C7D2FE" opacity="0.6"/>
                                        <circle cx="12" cy="16" r="0.8" fill="#C7D2FE" opacity="0.6"/>
                                    </g>
                                </svg>
                            </div>
                            <span id="theme-text" class="theme-label">Dark Mode</span>
                        </div>
                    </button>
                </div>
            </nav>

            <!-- LOGOUT -->
            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                            class="w-full py-2 px-4 rounded-lg flex items-center justify-between
                                   bg-red-600 hover:bg-red-700 text-white
                                   transition">
                        <span>Logout</span>
                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- MOBILE HEADER -->
        <header class="lg:hidden bg-white dark:bg-gray-800 shadow h-16 flex items-center px-4">
            <button id="open-sidebar-btn" class="text-gray-600 dark:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h2 class="mx-auto font-semibold"><?php echo $__env->yieldContent('title'); ?></h2>
            <div class="w-6"></div>
        </header>

        <!-- DESKTOP HEADER -->
        <header class="hidden lg:flex justify-between items-center px-6 h-16
                       bg-white dark:bg-gray-800 shadow">

            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                <?php echo $__env->yieldContent('title'); ?>
            </h2>
        </header>

        <!-- CONTENT -->
        <main class="flex-1 p-6 overflow-y-auto bg-gray-50 dark:bg-gray-900 content-fade-in">
            <div class="hidden lg:block mb-6">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                    <?php echo $__env->yieldContent('title'); ?>
                </h1>
            </div>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</div>

<div id="sidebar-overlay"
     class="fixed inset-0 bg-black/50 z-40 lg:hidden hidden"></div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const html = document.documentElement;
    const toggleBtn = document.getElementById("theme-toggle");
    const themeText = document.getElementById("theme-text");

    // Initialize theme
    if (localStorage.getItem("theme") === "dark") {
        html.classList.add("dark");
        toggleBtn.classList.remove("light-mode");
        toggleBtn.classList.add("dark-mode");
        themeText.textContent = "Dark Mode";
    } else {
        html.classList.remove("dark");
        toggleBtn.classList.remove("dark-mode");
        toggleBtn.classList.add("light-mode");
        themeText.textContent = "Light Mode";
    }

    // Toggle theme
    toggleBtn.addEventListener("click", () => {
        html.classList.toggle("dark");

        const isDark = html.classList.contains("dark");
        localStorage.setItem("theme", isDark ? "dark" : "light");

        // Update button state and text based on current theme
        if (isDark) {
            toggleBtn.classList.remove("light-mode");
            toggleBtn.classList.add("dark-mode");
            themeText.textContent = "Dark Mode";
        } else {
            toggleBtn.classList.remove("dark-mode");
            toggleBtn.classList.add("light-mode");
            themeText.textContent = "Light Mode";
        }
    });

    // Sidebar logic
    const sidebar = document.getElementById("sidebar");
    const openBtn = document.getElementById("open-sidebar-btn");
    const closeBtn = document.getElementById("close-sidebar-btn");
    const overlay = document.getElementById("sidebar-overlay");

    function openSidebar() {
        sidebar.classList.remove("-translate-x-full");
        overlay.classList.remove("hidden");
    }
    function closeSidebar() {
        sidebar.classList.add("-translate-x-full");
        overlay.classList.add("hidden");
    }

    openBtn?.addEventListener("click", openSidebar);
    closeBtn?.addEventListener("click", closeSidebar);
    overlay?.addEventListener("click", closeSidebar);
});
</script>

</body>
</html><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/layouts/admin.blade.php ENDPATH**/ ?>