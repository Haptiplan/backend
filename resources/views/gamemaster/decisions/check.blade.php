<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>
    <x-content-box>
        <!-- Centered Title with Elegant Font and Smooth Transition -->
        <x-page-title>
            {{ __('messages.decisionName') . ' ' . $period . ' ' . __('messages.fromGame') . ' ' . $game->name }}
        </x-page-title>
        <!-- Display Decision Details -->
        <div>
            <form class="space-y-4" action="{{ route('game.continue') }}" method="POST">
                @csrf
                @foreach ($companies as $company)
                <x-container>
                    <x-header-label>
                        {{ __('messages.company') . ': ' . $company->name }}
                    </x-header-label>
                    <input type="hidden" name="game_id" value="{{ $game->id }}" />
                    @php
                    // decisionmaker of the specific company
                    $currentDecisionMaker = $decision_makers->firstWhere('company_id', $company->id);
                    @endphp

                    @if ($currentDecisionMaker)
                    <details class="ml-10">
                        <summary>{{ __('messages.decisionMaker') . ': ' . $currentDecisionMaker->name }}</summary>
                        <ul class="list-disc pl-6">
                            <li class="ml-10">
                                {{ __('messages.createdAt') . ': ' . $decisions->where('player_id', $currentDecisionMaker->id)->first()->created_at->format('d.m.Y H:i') }}
                            </li>
                            @if($machines_bought->where('company_id', $company->id)->isNotEmpty())
                            <li class="ml-10">
                                {{ __('messages.machinesBought') . ": " }}
                                @foreach ($machines_bought->where('company_id', $company->id) as $machine)
                                <br>{{ '- ' . $machine->machinetype->name }}
                                @endforeach
                            </li>
                            @else
                            <li class="ml-10">
                                {{ __('messages.noMachinesBought') }}
                            </li>
                            @endif
                            @if($machines_sold->where('company_id', $company->id)->isNotEmpty())
                            <li class="ml-10">
                                {{ __('messages.machinesSold') . ': ' }}
                                @foreach ($machines_sold->where('company_id', $company->id) as $machine)
                                <br>{{ '- ' . $machine->machinetype->name . __('messages.fromPeriod') . $machine->period }}
                                @endforeach
                            </li>
                            @else
                            <li class="ml-10">
                                {{ __('messages.noMachinesSold') }}
                            </li>
                            @endif
                        </ul>
                    </details>
                    <input type="hidden" name="done[]" value="1">
                    @else
                    <li class="ml-10">
                        {{ __('messages.noDecisionYet') }}
                    </li>
                    @endif

                    @if ($game->current_period_number == $period)
                    <x-input-field type="checkbox" name="approve[]" required
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded checked:bg-green-500"/>
                    @endif
                </x-container>
                @endforeach
                <br>

                @if ($game->current_period_number == $period && $game->max_period_number > $period)
                <x-next-period-button>
                    {{ __('messages.continue') }}
                </x-next-period-button>
                @endif
            </form>

            <!-- Error Handling with Soft Background and Styled List -->
            <x-error-message />
            <x-success-message />

            <form id="periodForm" action="{{ route('decisions.check', ['id' => 1, 'period' => 0]) }}" method="GET">
                <label for="periods">{{ __('messages.choosePeriod') }}</label>
                <x-select-period  :maxPeriod="$game->current_period_number" :selected="$period"
                    onchange="updateFormAction()" />

                <!-- Submit Button with Gradient Background and Hover Effect -->
                <x-submit-button>
                    {{ __('Submit') }}
                </x-submit-button>
            </form>
            <script>
                function updateFormAction() {
                    var period = document.getElementById("periods").value;
                    var form = document.getElementById("periodForm");
                    // Update the action attribute of the form with the new period value
                    form.action = "{{ url('/check_decision/1') }}" + "/" + period;
                }
            </script>
        </div>
    </x-content-box>
</x-app-layout>