<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <!-- Layout Content Box -->
    <x-content-box>
        <x-page-title>
            {{ __('messages.results') }}
        </x-page-title>
        <x-error-message />
        <x-success-message />
        <div>
            @for ($i = 0; $i < $periods; $i++)
                <li class="ml-10">
                {{ __('messages.resultsOf') . " " . $i}}
                <x-show-button :href="route('accounts.show', $i)">
                    {{ __('messages.show') }}
                </x-show-button>
                
                @endfor
        </div>
    </x-content-box>

</x-app-layout>