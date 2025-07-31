<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <!-- Layout Content Box -->
    <x-content-box>
        <!-- Centered Title with Elegant Font and Smooth Transition -->
        <x-page-title>
            {{ __('messages.decisionName') . " " . $decision->period }}
        </x-page-title>

        <!-- List of Decisions -->
        <div class="mt-8">
            <x-header-label>
                {{ __('messages.period') }}:
            </x-header-label>
            <x-simple-text :text="$decision->period" />

            <x-header-label>
                {{ __('messages.decisionMaker') }}:
            </x-header-label>
            <x-simple-text :text="$decision_maker->name" />
        </div>
    </x-content-box>
</x-app-layout>