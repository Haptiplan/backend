<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($game->active == 1)
                        <h1 class="text-2xl font-bold mb-6">
                            {{ __('messages.decisionName') . ' ' . $period . ' ' . __('messages.fromGame') . ' ' . $game->name }}
                        </h1>
                        <div>
                            <form class="space-y-4" action="{{ route('game.continue') }}" method="POST">
                                @csrf
                                @foreach ($companies as $company)
                                    <h2 class="text-2xl font-bold mb-6">
                                        {{ __('messages.company') . ': ' . $company->name }}</h2>

                                    <input type="hidden" name="game_id" value="{{ $game->id }}">
                                    <li class="ml-10">
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
                                    <br>
                                @endforeach

                                @if ($game->current_period_number == $period)
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                        {{ __('messages.continue') }}
                                    </button>
                                @endif
                            </form>

                            @if ($errors->any())
                                <div
                                    class="alert alert-danger bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                    <ul class="block text-sm font-medium text-red-600 dark:text-red-300">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                    @endif
                    <form id="periodForm" action="{{ route('decision.check', ['id' => 1, 'period' => 0]) }}"
                        method="GET">
                        <label for="periods">{{ __('messages.choosePeriod') }}</label>
                        <select name="period" id="periods" onchange="updateFormAction()">
                            @for ($i = 0; $i <= $game->current_period_number; $i++)
                                <option value="{{ $i }}"> {{ $i }}</option>
                            @endfor
                        </select>
                        <button type="submit">{{ __('Submit') }}</button>
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
            </div>
        </div>
    </div>
</x-app-layout>
