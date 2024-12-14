<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ __('Profile Information') }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    {{ __("Update your account's profile information and email address.") }}
                </p>
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ __('Update Password') }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    {{ __('Ensure your account is using a long, random password to stay secure.') }}
                </p>
                @include('profile.partials.update-password-form')
            </div>

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ __('Delete Account') }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please download any important data before proceeding.') }}
                </p>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
