<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SGC</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('img/sgc-logo.png')); ?>" type="image/x-icon">

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
        .fade {
            animation: fadeIn 0.7s ease-out forwards;
        }

        .transition-theme {
            transition: background-color .4s ease, color .4s ease;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center transition-theme px-4
            bg-gradient-to-br from-sgcBlue/15 via-white to-sgcPurple/15
            dark:from-sgcDark dark:via-sgcDark dark:to-sgcDark/90">

    <!-- Toggle Theme -->
    <div class="absolute top-5 right-5 flex items-center gap-3">
        <button id="themeToggle"
            class="p-2 rounded-full backdrop-blur-xl transition 
                   bg-white/70 dark:bg-white/10 
                   shadow border border-white/30 dark:border-white/10">
            
            <!-- LIGHT ICON -->
            <svg id="sunIcon" class="w-6 h-6 text-yellow-500 hidden" fill="none" stroke="currentColor">
                <circle cx="12" cy="12" r="4"></circle>
                <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>
            </svg>

            <!-- DARK ICON -->
            <svg id="moonIcon" class="w-6 h-6 text-gray-100" viewBox="0 0 24 24" fill="currentColor">
                <path d="M21 12.8A9.2 9.2 0 0111.2 3
                        7.5 7.5 0 1019.5 15.8
                        9.3 9.3 0 0121 12.8z"/>
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
                            ring-2 ring-sgcBlue/40">
                    <img src="<?php echo e(asset('img/sgc-logo.png')); ?>" class="w-full h-full object-contain" />
                </div>
                <h1 class="mt-6 text-3xl font-bold text-gray-900 dark:text-white">
                    Masuk ke Akun Anda
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1 text-sm">
                    Silakan login untuk melanjutkan.
                </p>
            </div>

            <!-- 🔥 ERROR NOTIFICATION -->
            <?php if($errors->any()): ?>
                <div class="mb-6 p-4 rounded-xl bg-red-500/15 border border-red-500/30 
                            text-red-700 dark:text-red-300 dark:bg-red-900/30 
                            backdrop-blur-md shadow-lg fade">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M4.93 4.93l1.41 1.41M12 2v2m7.07 2.93l-1.41 1.41M20 12h-2m-2.93 7.07l-1.41-1.41M12 20v-2M6.34 17.66l-1.41-1.41"/>
                        </svg>
                        <span class="font-medium text-sm">
                            <?php echo e($errors->first()); ?>

                        </span>
                    </div>
                </div>
            <?php endif; ?>

            <!-- FORM -->
            <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>

                <!-- EMAIL -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Email</label>
                    <input name="email" type="email" required
                        class="w-full mt-1 px-4 py-3 rounded-xl transition-theme
                               bg-white/80 dark:bg-white/10
                               border border-gray-300 dark:border-white/20
                               text-gray-900 dark:text-white
                               placeholder-gray-400 dark:placeholder-gray-500
                               focus:ring-2 focus:ring-sgcBlue focus:border-transparent"
                        placeholder="email@example.com">
                </div>

                <!-- PASSWORD -->
                <div class="relative">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Password</label>

                    <input id="passwordInput" name="password" type="password" required
                        class="w-full mt-1 px-4 py-3 rounded-xl transition-theme 
                               bg-white/80 dark:bg-white/10
                               border border-gray-300 dark:border-white/20
                               text-gray-900 dark:text-white
                               placeholder-gray-400 dark:placeholder-gray-500
                               focus:ring-2 focus:ring-sgcPurple focus:border-transparent
                               pr-12"
                        placeholder="••••••••">

                    <!-- ICON SHOW/HIDE -->
                    <button type="button" id="togglePassword"
                        class="absolute top-9 right-4 text-gray-500 dark:text-gray-400 hover:text-gray-300 transition">
                        
                        <!-- Eye Open -->
                        <svg id="eyeOpen" class="w-5 h-5 hidden" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                                   -1.274 4.057-5.064 7-9.542 7 -4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>

                        <!-- Eye Closed -->
                        <svg id="eyeClosed" class="w-5 h-5" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7
                                   .516-1.644 1.438-3.09 2.626-4.25M6.43 6.43A9.969 9.969 0 0112 5c4.478 0 
                                   8.268 2.943 9.542 7a9.956 9.956 0 01-1.726 3.455"></path>
                            <path stroke-linecap="round" stroke-width="2"
                                d="M3 3l18 18"></path>
                        </svg>
                    </button>
                </div>

                <!-- REMEMBER + LUPA -->
                <div class="flex items-center justify-between text-sm">

                    <label class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                        <input type="checkbox"
                            class="rounded border-gray-400 dark:border-gray-600 focus:ring-sgcBlue">
                        Ingat saya
                    </label>

                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=rizkisuryapratama2020@gmail.com
                    &su=Permintaan%20Reset%20Password%20SGC
                    &body=Halo%20Admin%2C%0A%0ASaya%20ingin%20mengajukan%20permintaan%20reset%20password.%0A%0ATerima%20kasih."
                    target="_blank" class="text-sgcBlue hover:text-sgcPurple font-medium">
                        Lupa password?
                    </a>
                </div>

                <!-- BUTTON LOGIN -->
                <button type="submit"
                    class="w-full py-3 rounded-xl 
                           bg-gradient-to-r from-sgcBlue to-sgcPurple
                           text-white font-semibold shadow-xl hover:shadow-2xl
                           hover:scale-[1.03] transition-all">
                    Masuk
                </button>
            </form>

            <!-- REGISTER -->
            <p class="mt-8 text-center text-sm text-gray-700 dark:text-gray-300">
                Belum memiliki akun?
                <a href="<?php echo e(route('register')); ?>"
                    class="text-sgcBlue hover:text-sgcPurple font-medium">
                    Daftar di sini
                </a>
            </p>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        // SHOW/HIDE PASSWORD
        const passwordInput = document.getElementById("passwordInput");
        const togglePassword = document.getElementById("togglePassword");
        const eyeOpen = document.getElementById("eyeOpen");
        const eyeClosed = document.getElementById("eyeClosed");

        togglePassword.addEventListener("click", () => {
            const isHidden = passwordInput.type === "password";
            passwordInput.type = isHidden ? "text" : "password";

            eyeOpen.classList.toggle("hidden", !isHidden);
            eyeClosed.classList.toggle("hidden", isHidden);
        });

        // THEME TOGGLE
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

        // Load Theme
        setTheme(localStorage.getItem("theme") === "dark");
    </script>

</body>
</html>
<?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views/auth/login.blade.php ENDPATH**/ ?>