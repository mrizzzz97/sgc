<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'SGC Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = { darkMode: 'class' }
    </script>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <script>
        (function () {
            try {
                const theme = localStorage.getItem('theme');
                if (theme === 'dark') document.documentElement.classList.add('dark');
                else if (theme === 'light') document.documentElement.classList.remove('dark');
                else if (window.matchMedia('(prefers-color-scheme: dark)').matches)
                    document.documentElement.classList.add('dark');
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
        * { transition: all .25s ease; }
    </style>
</head>


<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">

    <!-- MOBILE NAV -->
    <div class="lg:hidden fixed top-0 left-0 w-full flex items-center justify-between px-4 py-3
                bg-white dark:bg-gray-800 shadow z-50">
        <button id="openSidebar"
            class="p-2 rounded-lg bg-gray-200 dark:bg-gray-700">
            <i class="fas fa-bars"></i>
        </button>

        <h1 class="text-lg font-semibold text-gray-900 dark:text-white">SGC</h1>

        <div class="w-9 h-9 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold shadow">
            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
        </div>
    </div>

    <div class="h-16 lg:hidden"></div>


    <div class="flex min-h-screen">

        <!-- DESKTOP SIDEBAR -->
        <aside class="hidden lg:flex flex-col w-72 bg-white dark:bg-gray-800 border-r dark:border-gray-700
                      p-6 sticky top-0 h-screen overflow-auto">

            <div class="flex items-center gap-3 mb-8">
                <img src="{{ asset('img/sgc-logo.png') }}" class="w-10 h-10 rounded-md shadow-sm">
                <div>
                    <h2 class="font-bold text-lg dark:text-white">SGC</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Front-End Class</p>
                </div>
            </div>

            <nav class="space-y-2">

                <a href="{{ route('murid.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700
                        {{ request()->routeIs('murid.dashboard') ? 'nav-active' : '' }}">
                    <i class="fas fa-home w-5"></i> Dashboard
                </a>

                <a href="{{ route('murid.modul') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-book w-5"></i> Modul
                </a>

                {{-- ================================
                     LEADERBOARD SLOT (OPTIONAL)
                     HANYA MUNCUL JIKA VIEW MENGISI
                ================================= --}}
                @yield('leaderboard_button')

                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700
                        {{ request()->routeIs('profile.edit') ? 'nav-active' : '' }}">
                    <i class="fas fa-user-cog w-5"></i> Profile
                </a>

                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl">
                        <i class="fas fa-sign-out-alt w-5"></i> Logout
                    </button>
                </form>

                <button id="toggleTheme"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl mt-3
                               bg-gray-200 dark:bg-gray-700">
                    <i id="themeIcon" class="fas fa-moon w-5"></i>
                    <span id="themeLabel">Dark Mode</span>
                </button>

            </nav>

            <p class="mt-auto text-xs text-gray-500 dark:text-gray-400 pt-6">
                © {{ date('Y') }} SGC Learning Dashboard
            </p>
        </aside>


        <!-- MOBILE SIDEBAR -->
        <div id="mobileSidebar"
             class="fixed top-0 left-0 w-64 h-full bg-white dark:bg-gray-800 shadow-xl p-6 z-50
                    transform -translate-x-full transition-all duration-300 lg:hidden">

            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/sgc-logo.png') }}" class="w-10 h-10 rounded-md shadow-sm">
                    <div>
                        <h2 class="font-bold text-lg dark:text-white">SGC</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Front-End Class</p>
                    </div>
                </div>
                <button id="closeSidebar" class="p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('murid.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-home w-5"></i> Dashboard
                </a>

                <a href="{{ route('murid.modul') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-book w-5"></i> Modul
                </a>

                {{-- Tidak membuat leaderboard disini untuk menghindari error $module --}}
                
                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-user-cog w-5"></i> Profile
                </a>

                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button class="w-full flex items-center gap-3 px-4 py-3 bg-red-500 text-white rounded-xl">
                        <i class="fas fa-sign-out-alt w-5"></i> Logout
                    </button>
                </form>

                <button id="toggleThemeMobile"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl mt-3
                               bg-gray-200 dark:bg-gray-700">
                    <i id="themeIconMobile" class="fas fa-moon w-5"></i>
                    <span id="themeLabelMobile">Dark Mode</span>
                </button>

            </nav>

        </div>

        <div id="sidebarOverlay"
             class="fixed inset-0 bg-black/50 hidden z-40 lg:hidden"></div>


        <!-- MAIN -->
        <main class="flex-1 p-6 lg:p-10">
            @yield('content')
        </main>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const openBtn = document.getElementById("openSidebar");
            const closeBtn = document.getElementById("closeSidebar");
            const sidebar = document.getElementById("mobileSidebar");
            const overlay = document.getElementById("sidebarOverlay");

            function open() {
                sidebar.classList.remove("-translate-x-full");
                overlay.classList.remove("hidden");
            }
            function close() {
                sidebar.classList.add("-translate-x-full");
                overlay.classList.add("hidden");
            }

            openBtn && (openBtn.onclick = open);
            closeBtn && (closeBtn.onclick = close);
            overlay && (overlay.onclick = close);

            // Theme toggle
            const themeBtn = document.getElementById("toggleTheme");
            const themeBtnMobile = document.getElementById("toggleThemeMobile");
            const icon = document.getElementById("themeIcon");
            const label = document.getElementById("themeLabel");
            const iconM = document.getElementById("themeIconMobile");
            const labelM = document.getElementById("themeLabelMobile");

            function applyUI() {
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
                if (dark) {
                    document.documentElement.classList.remove("dark");
                    localStorage.setItem("theme", "light");
                } else {
                    document.documentElement.classList.add("dark");
                    localStorage.setItem("theme", "dark");
                }
                applyUI();
            }

            themeBtn && (themeBtn.onclick = toggleTheme);
            themeBtnMobile && (themeBtnMobile.onclick = toggleTheme);

            applyUI();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')

</body>
</html>
