<x-app-layout>
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>
    <x-content-box>
        <x-page-title>
            {{ __('messages.decisionName') . ' ' . $period . ' ' . __('messages.fromGame') . ' ' . $game->name }}
        </x-page-title>
        <div>
            <form class="space-y-4" action="{{ route('game.continue') }}" method="POST">
                @csrf
                @foreach ($companies as $company)
                    <x-container>
                        <label class="underline decoration-yellow-400 ">
                            {{ __('messages.company') . ': ' . $company->name }}
                        </label>
                        <input type="hidden" name="game_id" value="{{ $game->id }}">
                        <li class="ml-10 font-semibold text-base text-gray-800 dark:text-gray-100 ">
                            {{ __('messages.decisionMaker') . ': ' }}
                            @foreach ($decision_makers as $decision_maker)
                                @if ($decision_maker->company_id == $company->id)
                                    {{ $decision_maker->name }}
                                    @if (!empty($decision_maker->name))
                                        <input type="hidden" name="done[]" value="1">
                                    @endif
                                @endif
                            @endforeach
                        </li>
                        @if ($game->current_period_number == $period)
                            <input type="checkbox" name="approve[]" required
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded checked:bg-green-500">
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

            @if ($errors->any())
                <div class="alert alert-danger bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <ul class="block text-sm font-medium text-red-600 dark:text-red-300">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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