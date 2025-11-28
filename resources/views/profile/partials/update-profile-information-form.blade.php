<section class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow mb-6">

    <header>
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    @if (session('status') === 'profile-updated')
        <p class="mt-4 text-sm text-green-400 font-semibold">
            ✔ Profile berhasil diperbarui
        </p>
    @endif

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- NAME --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Name
            </label>
            <input type="text" name="name"
                value="{{ old('name', auth()->user()->name) }}"
                class="w-full mt-1 rounded-lg border-gray-300 dark:border-gray-600
                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white" />
            @error('name')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Email
            </label>
            <input type="email" name="email"
                value="{{ old('email', auth()->user()->email) }}"
                class="w-full mt-1 rounded-lg border-gray-300 dark:border-gray-600
                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white" />
            @error('email')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button
            class="px-5 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 shadow transition">
            SAVE
        </button>
    </form>
</section>
