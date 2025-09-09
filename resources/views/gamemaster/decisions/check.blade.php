<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>
    <!-- Layout Content Box -->
    <x-content-box>
        <!-- Centered Title with Elegant Font and Smooth Transition -->
        <x-page-title>
            {{ __('messages.decisionName') . ' ' . $period . ' ' . __('messages.fromGame') . ' ' . $game->name }}
        </x-page-title>

        <!-- Display Decision Details -->
        <div>
            @if ($game->current_period_number != $period)
            <a href="{{ route('games.accounts.show', ['account' => $period, 'games' => $game->id]) }}">
                {{ __('messages.results') }}
            </a>
            <br><br>
            @endif
            <form class="space-y-4" action="{{ route('game.continue') }}" method="POST">
                @csrf
                @foreach ($companies as $company)
                    <x-container>
                        <x-header-label>
                            {{ __('messages.company') . ': ' . $company->name }}
                        </x-header-label>
                        <input type="hidden" name="game_id" value="{{ $game->id }}" />
                        <ul class="mt-2">
                            <li>
                                <x-simple-text :text="__('messages.decisionMaker') . ': '" />
                                @foreach ($decision_makers as $decision_maker)
                                    @if ($decision_maker->company_id == $company->id)
                                        <x-simple-text :text="$decision_maker->name" />
                                        @if (!empty($decision_maker->name))
                                            <input type="hidden" name="done[]" value="1">
                                        @endif
                                    @endif
                                @endforeach
                            </li>
                        </ul>
                        @if ($game->current_period_number == $period)
                            <x-input-field type="checkbox" name="approve[]" required
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded checked:bg-green-500" />
                        @endif
                    </x-container>
                    <br>
                @endforeach

                @if ($game->current_period_number == $period)
                    <x-next-period-button>
                        {{ __('messages.continue') }}
                    </x-next-period-button>
                @endif
            </form>

            <!-- Error Handling with Soft Background and Styled List -->
            <x-error-message />
            <x-success-message />

            <form id="periodForm" action="{{ route('decisions.check', ['id' => 1, 'period' => 0]) }}" method="GET"
                class="mt-6">
                <label for="periods">{{ __('messages.choosePeriod') }}</label>
                <x-select-period :maxPeriod="$game->current_period_number" :selected="$period"
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