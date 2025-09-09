<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <!-- Layout Content Box -->
    <x-content-box>
        <!-- Centered Title -->
        <x-page-title>
            {{ __('messages.decisionMake') }}
        </x-page-title>

        <!-- Error & Success Messages -->
        <x-error-message />
        <x-success-message />

        <form class="space-y-4" action="{{ route('decisions.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <x-header-label for="decision_name">
                    {{ __('messages.decisionName') . " " . $period}}
                </x-header-label>

                <x-header-label for="machinetype_id">
                    {{ __('messages.buyMachinetype')}}
                </x-header-label>
                @foreach ($machinetypes as $machinetype)
                    <div class="flex items-center">
                        <input type="radio" name="machinetype_id" id="machinetype_{{ $machinetype->id }}"
                            value="{{ $machinetype->id }}" class="mr-2">
                        <label for="buy[{{ $machinetype->id }}]" class="text-gray-800 dark:text-gray-200">
                            {{ $machinetype->name }} {{ __('messages.selectAmount') }}
                        </label>
                        <x-input-field type="number" name="buy[{{ $machinetype->id }}]" id="buy[{{ $machinetype->id }}]" min="0" max="3" value="0" step="1" />
                    </div>
                @endforeach

                <x-header-label for="sell">
                    {{ __('messages.sellMachine')}}
                </x-header-label>
                @foreach ($machines as $machine)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="sell[]" id="sell_{{ $machine->id }}" value="{{ $machine->id }}" class="mr-2">
                        <label for="sell_{{ $machine->id }}" class="text-gray-800 dark:text-gray-200">
                            {{ trans_choice('messages.machineType', 1) }}: {{ $machine->machinetype_id }}, ID: {{ $machine->id }}
                        </label>
                    </div>
                @endforeach

                <input type="hidden" name="player_id" id="player_id" value="{{$player->id}}" required>
                <input type="hidden" name="period" id="period" value="{{$period}}" required>
                <br>
                <x-header-label for="approve" class="text-red-700 dark:text-red-300">
                    {{ __('messages.decisionApprove') }}
                </x-header-label>
                <x-input-field type="checkbox" name="approve" id="approve" required class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded checked:bg-red-500" />
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <x-submit-button>
                    {{ __('messages.create') }}
                </x-submit-button>
            </div>
        </form>

        <div class="mt-8">
            <x-header-label>
                {{ __('messages.previousDecisions') }}
            </x-header-label>
            <ul>
                @foreach ($decisions as $decision)
                    <li class="ml-10">
                        {{ __('messages.decisionName') . " " . $decision->period}}
                        <a href="{{ route('decisions.show', $decision->id) }}"
                            class="inline-flex items-center px-2 py-1 border border-transparent rounded-md font-semibold font-medium text-gray-700 dark:text-gray-300 tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                            {{ __('messages.show') }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </x-content-box>
</x-app-layout>