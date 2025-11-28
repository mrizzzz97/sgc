<section class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow mb-6">

    <header>
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
            Ensure your account is using a secure password.
        </p>
    </header>

    {{-- NOTIF BERHASIL --}}
    @if (session('status') === 'password-updated')
        <p class="mt-4 text-sm text-green-400 font-semibold">
            ✔ Password berhasil diperbarui
        </p>
    @endif

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- CURRENT PASSWORD --}}
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Current Password
            </label>

            <input id="current_password" name="current_password" type="password"
                class="w-full mt-1 rounded-lg border-gray-300 dark:border-gray-600
                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                required />

            @error('current_password')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- NEW PASSWORD --}}
        <div>
            <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                New Password
            </label>

            <input id="new_password" name="new_password" type="password"
                class="w-full mt-1 rounded-lg border-gray-300 dark:border-gray-600
                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                required />

            @error('new_password')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- CONFIRM --}}
        <div>
            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Confirm Password
            </label>

            <input id="new_password_confirmation" name="new_password_confirmation" type="password"
                class="w-full mt-1 rounded-lg border-gray-300 dark:border-gray-600
                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                required />
        </div>

        <button
            class="px-5 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 shadow transition">
            SAVE
        </button>
    </form>
</section>
