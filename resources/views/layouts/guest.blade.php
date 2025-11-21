<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow">

            <h2 class="text-3xl font-bold text-center text-indigo-600 mb-6">
                Daftar Akun SGC
            </h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" required
                        class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-600 focus:ring-indigo-600">
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <label class="block font-medium text-gray-700">Email</label>
                    <input type="email" name="email" required
                        class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-600 focus:ring-indigo-600">
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label class="block font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required
                        class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-600 focus:ring-indigo-600">
                </div>

                <!-- Confirm -->
                <div class="mt-4">
                    <label class="block font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-600 focus:ring-indigo-600">
                </div>

                <div class="mt-6">
                    <button
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition">
                        Daftar
                    </button>
                </div>

                <p class="text-center mt-4 text-gray-600 text-sm">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">
                        Masuk
                    </a>
                </p>
            </form>

        </div>
    </div>
</x-guest-layout>
