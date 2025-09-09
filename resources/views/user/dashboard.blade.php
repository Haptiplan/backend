<x-app-layout>
    <x-dashboard-header>
    {{ __('Dashboard') }}
</x-dashboard-header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('messages.loggedIn') }}
                    <h1>{{ __('messages.userDashboard') }}</h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>