<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'SGC Dashboard')</title>
    <link rel="shortcut icon" href="{{ asset('img/sgc-logo.png') }}" type="image/x-icon">


    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = { 
            darkMode: 'class',
            theme: {
                extend: {
                    transitionTimingFunction: {
                        'smooth': 'cubic-bezier(0.4, 0, 0.2, 1)',
                    },
                    boxShadow: {
                        'glow': '0 0 18px rgba(99,102,241,0.5)',
                    }
                }
            }
        }
    </script>

    <!-- ICON -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- LOAD USER THEME -->
    <script>
        (() => {
            try {
                const theme = localStorage.getItem('theme');
                if (theme === 'dark') document.documentElement.classList.add('dark');
            } catch (e) {}
        })();
    </script>

    <style>
        /* NAV ACTIVE */
        .nav-active {
            background: linear-gradient(135deg, rgba(99,102,241,0.22), rgba(139,92,246,0.22));
            color: #6366f1 !important;
            font-weight: 700;
            transform: scale(1.02);
        }

        .nav-item {
            transition: all .25s cubic-bezier(.4,0,.2,1);
        }

        .nav-item:hover {
            background-color: rgba(99,102,241,0.15);
            transform: translateX(6px);
            box-shadow: 0 2px 10px rgba(99,102,241,0.25);
        }

        /* DARK NAV HOVER */
        .dark .nav-item:hover {
            background-color: rgba(139,92,246,0.18);
            box-shadow: 0 2px 10px rgba(139,92,246,0.35);
        }

        /* SIDEBAR SLIDE */
        #mobileSidebar {
            transition: transform .33s cubic-bezier(.4,0,.2,1), opacity .33s ease;
        }

        /* OVERLAY FADE */
        #sidebarOverlay {
            transition: opacity .25s ease;
        }

        /* THEME TOGGLE ROTATE */
        #themeIcon {
            transition: transform .2s ease, opacity .2s ease;
        }

        /* GLOBAL SMOOTH TRANSITION */
        * { transition: background-color .25s ease, color .2s ease, border-color .25s ease; }
    </style>
</head>


<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">

    <!-- MOBILE NAV -->
    <div class="lg:hidden fixed top-0 left-0 w-full flex items-center justify-between px-4 py-3
                bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl shadow z-50">
        <button id="openSidebar" class="p-2 rounded-lg bg-gray-200 dark:bg-gray-700 hover:scale-105 active:scale-95 transition">
            <i class="fas fa-bars"></i>
        </button>

        <h1 class="text-lg font-bold tracking-wide">SGC</h1>

        <div class="w-9 h-9 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold shadow">
            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
        </div>
    </div>

    <div class="h-16 lg:hidden"></div>

    <!-- WRAPPER -->
    <div class="flex min-h-screen">

        <!-- ============= DESKTOP SIDEBAR ============= -->
        <aside class="hidden lg:flex flex-col w-72 bg-white dark:bg-gray-800 border-r dark:border-gray-700
                      p-6 sticky top-0 h-screen overflow-auto shadow-lg">

            <!-- BRAND -->
            <div class="flex items-center gap-3 mb-8 transform hover:scale-[1.02] transition">
                <img src="{{ asset('img/sgc-logo.png') }}" class="w-10 h-10 rounded-xl shadow">
                <div>
                    <h2 class="font-bold text-lg dark:text-white">SGC</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Front-End Class</p>
                </div>
            </div>

            <!-- NAV -->
            <nav class="space-y-2">

                <a href="{{ route('murid.dashboard') }}"
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl
                          {{ request()->routeIs('murid.dashboard') ? 'nav-active' : '' }}">
                    <i class="fas fa-home w-5"></i> Dashboard
                </a>

                <a href="{{ route('murid.modul') }}"
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl">
                    <i class="fas fa-book w-5"></i> Modul
                </a>

                @yield('leaderboard_button')

                <a href="{{ route('profile.edit') }}"
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl
                          {{ request()->routeIs('profile.edit') ? 'nav-active' : '' }}">
                    <i class="fas fa-user-cog w-5"></i> Profile
                </a>

                <a href="{{ route('murid.leaderboard') }}"
                class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl
                        {{ request()->routeIs('murid.leaderboard') ? 'nav-active' : '' }}">
                    <i class="fas fa-trophy w-5"></i> Leaderboard
                </a>


                <!-- LOGOUT -->
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 bg-red-500 hover:bg-red-600
                               text-white rounded-xl shadow-md hover:shadow-xl hover:scale-[1.02] transition">
                        <i class="fas fa-sign-out-alt w-5"></i> Logout
                    </button>
                </form>

                <!-- THEME TOGGLE -->
                <button id="toggleTheme"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl mt-3
                               bg-gray-200 dark:bg-gray-700 hover:scale-[1.02] active:scale-95 transition">
                    <i id="themeIcon" class="fas fa-moon w-5"></i>
                    <span id="themeLabel">Dark Mode</span>
                </button>

            </nav>

            <p class="mt-auto text-xs text-gray-500 dark:text-gray-400 pt-6 text-center">
                © {{ date('Y') }} SGC Learning Dashboard
            </p>
        </aside>
        <!-- ============= MOBILE SIDEBAR ============= -->
        <div id="mobileSidebar"
             class="fixed top-0 left-0 w-64 h-full bg-white dark:bg-gray-800 shadow-xl p-6 z-50
                    transform -translate-x-full opacity-0 lg:hidden rounded-r-2xl">

            <!-- HEADER -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/sgc-logo.png') }}" class="w-10 h-10 rounded-xl shadow">
                    <div>
                        <h2 class="font-bold text-lg dark:text-white">SGC</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Front-End Class</p>
                    </div>
                </div>

                <button id="closeSidebar"
                        class="p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition active:scale-95">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- NAV -->
            <nav class="space-y-2">

                <a href="{{ route('murid.dashboard') }}"
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl">
                    <i class="fas fa-home w-5"></i> Dashboard
                </a>

                <a href="{{ route('murid.modul') }}"
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl">
                    <i class="fas fa-book w-5"></i> Modul
                </a>

                <a href="{{ route('murid.leaderboard') }}"
                class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl
                        {{ request()->routeIs('murid.leaderboard') ? 'nav-active' : '' }}">
                    <i class="fas fa-trophy w-5"></i> Leaderboard
                </a>


                <a href="{{ route('profile.edit') }}"
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl">
                    <i class="fas fa-user-cog w-5"></i> Profile
                </a>

                <!-- LOGOUT -->
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button
                        class="w-full flex items-center gap-3 px-4 py-3 bg-red-500 hover:bg-red-600
                               text-white rounded-xl shadow-md hover:shadow-xl hover:scale-[1.02] transition">
                        <i class="fas fa-sign-out-alt w-5"></i> Logout
                    </button>
                </form>

                <!-- THEME TOGGLE MOBILE -->
                <button id="toggleThemeMobile"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl mt-3
                               bg-gray-200 dark:bg-gray-700 hover:scale-[1.02] transition active:scale-95">
                    <i id="themeIconMobile" class="fas fa-moon w-5"></i>
                    <span id="themeLabelMobile">Dark Mode</span>
                </button>

            </nav>

        </div>

        <div id="sidebarOverlay"
             class="fixed inset-0 bg-black/50 opacity-0 hidden z-40 lg:hidden"></div>


        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 lg:p-10 animate-fade">
            @yield('content')
        </main>

    </div> <!-- END WRAPPER -->

    <!-- ============= SCRIPT ANIMASI ============= -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            /* ---------- MOBILE SIDEBAR ---------- */
            const openBtn = document.getElementById("openSidebar");
            const closeBtn = document.getElementById("closeSidebar");
            const sidebar = document.getElementById("mobileSidebar");
            const overlay = document.getElementById("sidebarOverlay");

            function openSidebar() {
                sidebar.classList.remove("-translate-x-full");
                sidebar.classList.remove("opacity-0");
                overlay.classList.remove("hidden");
                setTimeout(() => { overlay.style.opacity = 1 }, 10);
            }

            function closeSidebar() {
                sidebar.classList.add("-translate-x-full");
                sidebar.classList.add("opacity-0");
                overlay.style.opacity = 0;
                setTimeout(() => { overlay.classList.add("hidden"); }, 250);
            }

            openBtn && (openBtn.onclick = openSidebar);
            closeBtn && (closeBtn.onclick = closeSidebar);
            overlay && (overlay.onclick = closeSidebar);


            /* ---------- THEME TOGGLE ---------- */
            const themeBtn = document.getElementById("toggleTheme");
            const themeBtnMobile = document.getElementById("toggleThemeMobile");
            const icon = document.getElementById("themeIcon");
            const label = document.getElementById("themeLabel");
            const iconM = document.getElementById("themeIconMobile");
            const labelM = document.getElementById("themeLabelMobile");

            function applyThemeUI() {
                const dark = document.documentElement.classList.contains("dark");
                if (dark) {
                    icon.className = iconM.className = "fas fa-sun w-5";
                    label.textContent = labelM.textContent = "Light Mode";
                } else {
                    icon.className = iconM.className = "fas fa-moon w-5";
                    label.textContent = labelM.textContent = "Dark Mode";
                }
            }

            function toggleTheme() {
                const dark = document.documentElement.classList.contains("dark");
                
                icon.style.opacity = 0;
                setTimeout(() => {
                    icon.style.transform = dark ? "rotate(-90deg)" : "rotate(90deg)";
                }, 120);
                
                if (dark) {
                    document.documentElement.classList.remove("dark");
                    localStorage.setItem("theme", "light");
                } else {
                    document.documentElement.classList.add("dark");
                    localStorage.setItem("theme", "dark");
                }

                setTimeout(() => { icon.style.opacity = 1; }, 180);

                applyThemeUI();
            }

            themeBtn && (themeBtn.onclick = toggleTheme);
            themeBtnMobile && (themeBtnMobile.onclick = toggleTheme);

            applyThemeUI();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')

</body>
</html>
