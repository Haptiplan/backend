<x-app-layout>
   <x-dashboard-header>
    {{ __('Dashboard') }}
</x-dashboard-header>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">{{ __('messages.decisionName') . " " . $decision->period }}</h1>
                    <div>
                        <li class="ml-10">
                            {{ __('messages.period') . ": " . $decision->period}}
                        </li>
                        <li class="ml-10">
                            {{ __('messages.decisionMaker') . ": " . $decision_maker->name}}
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>