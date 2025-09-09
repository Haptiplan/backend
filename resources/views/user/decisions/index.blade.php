<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <!-- Layout Content Box -->
    <x-content-box>
        <x-page-title>
            {{ trans_choice('messages.decision', $decisions) }}
        </x-page-title>
        <x-error-message />
        <x-success-message />

        <div>
            @foreach ($decisions as $decision)
            <li class="ml-10">
                {{ __('messages.decisionName') . " " . $decision->period}}
                <x-show-button :href="route('decisions.show', $decision->id)">
                    {{ __('messages.show') }}
                </x-show-button>
            </li>
            @endforeach
        </div>
    </x-content-box>

</x-app-layout>