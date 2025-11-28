<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title><?php echo $__env->yieldContent('title', 'SGC Dashboard'); ?></title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FIX: Dark mode Tailwind -->
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    <!-- Icons -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Apply saved theme BEFORE render -->
    <script>
        (function () {
            try {
                const theme = localStorage.getItem('theme');
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                } else if (theme === 'light') {
                    document.documentElement.classList.remove('dark');
                } else {
                    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        document.documentElement.classList.add('dark');
                    }
                }
            } catch (e) {}
        })();
    </script>

    <style>
        .nav-active {
            background-color: rgba(99,102,241,0.16);
            color: #4f46e5 !important;
            font-weight: 600;
        }
        .nav-active i { color: inherit !important; }

        * {
            transition: background-color .25s ease, color .25s ease, border-color .25s ease;
        }
    </style>
</head>


<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">

    <!-- MOBILE NAV -->
    <div class="lg:hidden fixed top-0 left-0 w-full flex items-center justify-between px-4 py-3
                bg-white dark:bg-gray-800 shadow z-50">
        <button id="openSidebar"
            class="p-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
            <i class="fas fa-bars"></i>
        </button>

        <h1 class="text-lg font-semibold text-gray-900 dark:text-white">SGC</h1>

        <div class="w-9 h-9 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold shadow">
            <?php echo e(strtoupper(substr(Auth::user()->name ?? 'U', 0, 1))); ?>

        </div>
    </div>

    <div class="h-16 lg:hidden"></div>


    <div class="flex min-h-screen">

        <!-- SIDEBAR DESKTOP -->
        <aside class="hidden lg:flex flex-col w-72 bg-white dark:bg-gray-800 border-r dark:border-gray-700
                      p-6 sticky top-0 h-screen overflow-auto">

            <div class="flex items-center gap-3 mb-8">
                <img src="<?php echo e(asset('img/sgc-logo.png')); ?>" class="w-10 h-10 rounded-md shadow-sm">
                <div>
                    <h2 class="font-bold text-lg text-gray-900 dark:text-white">SGC</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Front-End Class</p>
                </div>
            </div>

            <nav class="space-y-2">

                <a href="<?php echo e(route('murid.dashboard')); ?>"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700
                        text-gray-700 dark:text-gray-300
                        <?php echo e(request()->routeIs('murid.dashboard') ? 'nav-active' : ''); ?>">
                    <i class="fas fa-home w-5"></i> Dashboard
                </a>

                <a href="<?php echo e(route('murid.tugas')); ?>"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700
                        text-gray-700 dark:text-gray-300
                        <?php echo e(request()->routeIs('murid.tugas') ? 'nav-active' : ''); ?>">
                    <i class="fas fa-tasks w-5"></i> Tugas
                </a>

                <a href="<?php echo e(route('murid.modul')); ?>"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700
                        text-gray-700 dark:text-gray-300">
                    <i class="fas fa-book w-5"></i> Modul
                </a>

                <a href="#"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700
                        text-gray-700 dark:text-gray-300">
                    <i class="fas fa-trophy w-5"></i> Leaderboard
                </a>

                <a href="<?php echo e(route('profile.edit')); ?>"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700
                        text-gray-700 dark:text-gray-300
                        <?php echo e(request()->routeIs('profile.edit') ? 'nav-active' : ''); ?>">
                    <i class="fas fa-user-cog w-5"></i> Profile
                </a>

                <!-- LOGOUT -->
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-3">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl">
                        <i class="fas fa-sign-out-alt w-5"></i> Logout
                    </button>
                </form>

                <!-- THEME SWITCH -->
                <button id="toggleTheme"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl mt-3
                               bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                    <i id="themeIcon" class="fas fa-moon w-5"></i>
                    <span id="themeLabel">Dark Mode</span>
                </button>

            </nav>

            <p class="mt-auto text-xs text-gray-500 dark:text-gray-400 pt-6">
                © <?php echo e(date('Y')); ?> SGC Learning Dashboard
            </p>
        </aside>


        <!-- SIDEBAR MOBILE -->
        <div id="mobileSidebar"
             class="fixed top-0 left-0 w-64 h-full bg-white dark:bg-gray-800 shadow-xl p-6 z-50
                    transform -translate-x-full transition-all duration-300 lg:hidden">

            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <img src="<?php echo e(asset('img/sgc-logo.png')); ?>" class="w-10 h-10 rounded-md shadow-sm">
                    <div>
                        <h2 class="font-bold text-lg text-gray-900 dark:text-white">SGC</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Front-End Class</p>
                    </div>
                </div>
                <button id="closeSidebar"
                        class="p-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <nav class="space-y-2">
                <a href="<?php echo e(route('murid.dashboard')); ?>"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700
                        text-gray-700 dark:text-gray-300
                        <?php echo e(request()->routeIs('murid.dashboard') ? 'nav-active' : ''); ?>">
                    <i class="fas fa-home w-5"></i> Dashboard
                </a>

                <a href="<?php echo e(route('murid.tugas')); ?>"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700
                        text-gray-700 dark:text-gray-300
                        <?php echo e(request()->routeIs('murid.tugas') ? 'nav-active' : ''); ?>">
                    <i class="fas fa-tasks w-5"></i> Tugas
                </a>

                <a href="<?php echo e(route('murid.modul')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700
                        text-gray-700 dark:text-gray-300">
                    <i class="fas fa-book w-5"></i> Modul
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700
                        text-gray-700 dark:text-gray-300">
                    <i class="fas fa-trophy w-5"></i> Leaderboard
                </a>

                <a href="<?php echo e(route('profile.edit')); ?>"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700
                        text-gray-700 dark:text-gray-300
                        <?php echo e(request()->routeIs('profile.edit') ? 'nav-active' : ''); ?>">
                    <i class="fas fa-user-cog w-5"></i> Profile
                </a>

                <!-- Logout -->
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-3">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600">
                        <i class="fas fa-sign-out-alt w-5"></i> Logout
                    </button>
                </form>

                <!-- Theme -->
                <button id="toggleThemeMobile"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl mt-3
                               bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                    <i id="themeIconMobile" class="fas fa-moon w-5"></i>
                    <span id="themeLabelMobile">Dark Mode</span>
                </button>

            </nav>

        </div>

        <div id="sidebarOverlay"
             class="fixed inset-0 bg-black/50 hidden z-40 lg:hidden"></div>


        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 lg:p-10">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

    </div>

    <!-- SCRIPT -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            
            // sidebar elements
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


            // theme buttons
            const themeBtn = document.getElementById("toggleTheme");
            const themeBtnMobile = document.getElementById("toggleThemeMobile");

            const icon = document.getElementById("themeIcon");
            const label = document.getElementById("themeLabel");
            const iconM = document.getElementById("themeIconMobile");
            const labelM = document.getElementById("themeLabelMobile");

            function applyUI() {
                const dark = document.documentElement.classList.contains("dark");

                if (dark) {
                    icon.className = "fas fa-sun w-5";
                    label.textContent = "Light Mode";
                    iconM.className = "fas fa-sun w-5";
                    labelM.textContent = "Light Mode";
                } else {
                    icon.className = "fas fa-moon w-5";
                    label.textContent = "Dark Mode";
                    iconM.className = "fas fa-moon w-5";
                    labelM.textContent = "Dark Mode";
                }
            }

            function toggleTheme() {
                const dark = document.documentElement.classList.contains("dark");
                if (dark) {
                    document.documentElement.classList.remove("dark");
                    localStorage.setItem("theme", "light");
                } else {
                    document.documentElement.classList.add("dark");
                    localStorage.setItem("theme", "dark");
                }
                applyUI();
            }

            if (themeBtn) themeBtn.onclick = toggleTheme;
            if (themeBtnMobile) themeBtnMobile.onclick = toggleTheme;

            applyUI();
        });
    </script>

</body>
</html>
<?php /**PATH C:\school\IDN kls 10\lomba-lomba\te\laravel\sgc\resources\views/layouts/dashboard.blade.php ENDPATH**/ ?>