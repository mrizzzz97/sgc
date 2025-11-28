<nav class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LEFT: Logo -->
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-3">
                    <img src="{{ asset('img/sgc-logo.png') }}" 
                         class="h-10 w-10 rounded-lg object-cover shadow-sm" 
                         alt="Logo">
                    <span class="font-semibold text-xl text-indigo-600">
                        SGC
                    </span>
                </a>
            </div>

            <!-- CENTER: Menu -->
            <div class="hidden sm:flex space-x-8 items-center">
                <a href="/" class="text-gray-700 hover:text-indigo-600 font-medium">Home</a>
                <a href="/modules" class="text-gray-700 hover:text-indigo-600 font-medium">Modul</a>
                <a href="/features" class="text-gray-700 hover:text-indigo-600 font-medium">Features</a>
            </div>

            <!-- RIGHT: User + Buttons -->
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-gray-700 font-medium">
                        {{ Auth::user()->name }}
                    </span>

                    <a href="{{ route('dashboard') }}" 
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                        Dashboard
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="px-4 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>

        </div>
    </div>
</nav>
