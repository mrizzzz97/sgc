@extends('layouts.dashboard')

@section('title', 'Profile')

@section('content')

<div class="max-w-4xl mx-auto space-y-10">

    {{-- PROFILE INFORMATION --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">
            Profile Information
        </h2>

        @include('profile.partials.update-profile-information-form')
    </div>


    {{-- UPDATE PASSWORD --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">
            Update Password
        </h2>

        @include('profile.partials.update-password-form')
    </div>


    {{-- DELETE USER --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">
            Delete Account
        </h2>

        @include('profile.partials.delete-user-form')
    </div>

</div>

@endsection
