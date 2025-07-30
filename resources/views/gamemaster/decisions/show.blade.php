<x-app-layout>
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>
    <x-content-box>
        <x-page-title>{{ __('messages.decisionName') . " " . $decision->period }}
            
        </x-page-title>
        <div>
            <li class="ml-10">
                {{ __('messages.period') . ": " . $decision->period}}
            </li>
            <li class="ml-10">
                {{ __('messages.decisionMaker') . ": " . $decision_maker->name}}
            </li>
        </div>
    </x-content-box>
</x-app-layout>