<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SGC</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/sgc-logo.png') }}" type="image/x-icon">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        sgcBlue: "#2563eb",
                        sgcPurple: "#7c3aed",
                        sgcDark: "#0f172a",
                        sgcGlassLight: "rgba(255,255,255,0.45)",
                        sgcGlassDark: "rgba(255,255,255,0.08)",
                    }
                }
            }
        };
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade { animation: fadeIn 0.7s ease-out forwards; }

        .transition-theme {
            transition: background-color .4s ease, color .4s ease;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4 transition-theme
            bg-gradient-to-br from-sgcBlue/15 via-white to-sgcPurple/15
            dark:from-sgcDark dark:via-sgcDark dark:to-sgcDark/90">

    <!-- Toggle Theme -->
    <div class="absolute top-5 right-5 flex items-center gap-3">
        <button id="themeToggle"
            class="p-2 rounded-full backdrop-blur-xl transition 
                   bg-white/70 dark:bg-white/10 
                   shadow border border-white/30 dark:border-white/10">

            <!-- Sun Icon -->
            <svg id="sunIcon" class="w-6 h-6 text-yellow-500 hidden" fill="none" stroke="currentColor">
                <circle cx="12" cy="12" r="4"></circle>
                <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41
                         M17.66 17.66l1.41 1.41M2 12h2
                         M20 12h2M4.93 19.07l1.41-1.41
                         M17.66 6.34l1.41-1.41" />
            </svg>

            <!-- Moon Icon (tebal & jelas) -->
            <svg id="moonIcon" class="w-6 h-6 text-gray-100" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12.5 2A10 10 0 1 0 22 12.5
                         7 7 0 1 1 12.5 2z" />
            </svg>
        </button>
    </div>

    <!-- Card Wrapper -->
    <div class="max-w-md w-full fade">

        <div class="p-10 rounded-3xl backdrop-blur-xl transition-theme
                    bg-sgcGlassLight dark:bg-sgcGlassDark
                    border border-white/30 dark:border-white/10
                    shadow-2xl">

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="mx-auto w-24 h-24 rounded-2xl overflow-hidden shadow-lg 
                            ring-2 ring-sgcPurple/40">
                    <img src="{{ asset('img/sgc-logo.png') }}" class="w-full h-full object-contain" />
                </div>
                <h1 class="mt-6 text-3xl font-bold text-gray-900 dark:text-white">
                    Buat Akun Baru
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1 text-sm">
                    Daftar untuk mulai belajar di SGC.
                </p>
            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- NAME -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Nama Lengkap
                    </label>
                    <input name="name" type="text" required
                           class="w-full mt-1 px-4 py-3 rounded-xl 
                                  bg-white/80 dark:bg-white/10
                                  border border-gray-300 dark:border-white/20
                                  text-gray-900 dark:text-white
                                  placeholder-gray-400 dark:placeholder-gray-500
                                  focus:ring-2 focus:ring-sgcBlue focus:border-transparent transition"
                           placeholder="Nama kamu"
                           value="{{ old('name') }}">
                </div>

                <!-- EMAIL -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Email
                    </label>
                    <input name="email" type="email" required
                           class="w-full mt-1 px-4 py-3 rounded-xl 
                                  bg-white/80 dark:bg-white/10
                                  border border-gray-300 dark:border-white/20
                                  text-gray-900 dark:text-white
                                  placeholder-gray-400 dark:placeholder-gray-500
                                  focus:ring-2 focus:ring-sgcPurple focus:border-transparent transition"
                           placeholder="email@example.com"
                           value="{{ old('email') }}">
                </div>

                <!-- PASSWORD -->
                <div class="relative">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Password
                    </label>

                    <input id="password" name="password" type="password" required
                           class="w-full mt-1 px-4 py-3 rounded-xl 
                                  bg-white/80 dark:bg-white/10
                                  border border-gray-300 dark:border-white/20
                                  text-gray-900 dark:text-white
                                  placeholder-gray-400 dark:placeholder-gray-500
                                  focus:ring-2 focus:ring-sgcBlue focus:border-transparent transition pr-12"
                           placeholder="Minimal 8 karakter">

                    <!-- Toggle Icon -->
                    <button type="button" id="togglePassword"
                        class="absolute top-9 right-4 text-gray-500 dark:text-gray-400 hover:text-gray-300">

                        <!-- Eye Open -->
                        <svg id="eyeOpen1" class="w-5 h-5 hidden" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                                   -1.274 4.057-5.064 7-9.542 7 -4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>

                        <!-- Eye Closed -->
                        <svg id="eyeClosed1" class="w-5 h-5" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7
                                   .516-1.644 1.438-3.09 2.626-4.25M6.43 6.43A9.969 9.969 0 0112 5c4.478 0 
                                   8.268 2.943 9.542 7a9.956 9.956 0 01-1.726 3.455"></path>
                            <path stroke-linecap="round" stroke-width="2"
                                d="M3 3l18 18"></path>
                        </svg>
                    </button>
                </div>

                <!-- CONFIRM PASSWORD -->
                <div class="relative">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Konfirmasi Password
                    </label>

                    <input id="password2" name="password_confirmation" type="password" required
                           class="w-full mt-1 px-4 py-3 rounded-xl 
                                  bg-white/80 dark:bg-white/10
                                  border border-gray-300 dark:border-white/20
                                  text-gray-900 dark:text-white
                                  placeholder-gray-400 dark:placeholder-gray-500
                                  focus:ring-2 focus:ring-sgcPurple focus:border-transparent transition pr-12"
                           placeholder="Ulangi password">

                    <!-- Toggle Icon -->
                    <button type="button" id="togglePassword2"
                        class="absolute top-9 right-4 text-gray-500 dark:text-gray-400 hover:text-gray-300">

                        <!-- Eye Open -->
                        <svg id="eyeOpen2" class="w-5 h-5 hidden" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                                   -1.274 4.057-5.064 7-9.542 7 -4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>

                        <!-- Eye Closed -->
                        <svg id="eyeClosed2" class="w-5 h-5" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7
                                   .516-1.644 1.438-3.09 2.626-4.25M6.43 6.43A9.969 9.969 0 0112 5c4.478 0 
                                   8.268 2.943 9.542 7a9.956 9.956 0 01-1.726 3.455"></path>
                            <path stroke-linecap="round" stroke-width="2"
                                d="M3 3l18 18"></path>
                        </svg>
                    </button>
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full py-3 rounded-xl 
                           bg-gradient-to-r from-sgcBlue to-sgcPurple
                           text-white font-semibold shadow-xl hover:shadow-2xl
                           hover:scale-[1.03] transition-all">
                    Daftar Sekarang
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-gray-700 dark:text-gray-300">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                    class="text-sgcBlue hover:text-sgcPurple font-medium">
                    Masuk di sini
                </a>
            </p>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        // Dark Mode Toggle
        const themeToggle = document.getElementById("themeToggle");
        const sunIcon = document.getElementById("sunIcon");
        const moonIcon = document.getElementById("moonIcon");

        function setTheme(dark) {
            document.documentElement.classList.toggle("dark", dark);
            sunIcon.classList.toggle("hidden", !dark);
            moonIcon.classList.toggle("hidden", dark);
            localStorage.setItem("theme", dark ? "dark" : "light");
        }

        themeToggle.addEventListener("click", () => {
            setTheme(!document.documentElement.classList.contains("dark"));
        });

        setTheme(localStorage.getItem("theme") === "dark");

        // Show/Hide Password
        const password = document.getElementById("password");
        const password2 = document.getElementById("password2");

        const togglePassword = document.getElementById("togglePassword");
        const togglePassword2 = document.getElementById("togglePassword2");

        const eyeOpen1 = document.getElementById("eyeOpen1");
        const eyeClosed1 = document.getElementById("eyeClosed1");

        const eyeOpen2 = document.getElementById("eyeOpen2");
        const eyeClosed2 = document.getElementById("eyeClosed2");

        togglePassword.addEventListener("click", () => {
            const hidden = password.type === "password";
            password.type = hidden ? "text" : "password";
            eyeOpen1.classList.toggle("hidden", !hidden);
            eyeClosed1.classList.toggle("hidden", hidden);
        });

        togglePassword2.addEventListener("click", () => {
            const hidden = password2.type === "password";
            password2.type = hidden ? "text" : "password";
            eyeOpen2.classList.toggle("hidden", !hidden);
            eyeClosed2.classList.toggle("hidden", hidden);
        });
    </script>

</body>
</html>
