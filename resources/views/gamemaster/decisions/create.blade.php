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
                    <h1 class="text-2xl font-bold mb-6">{{ __('messages.decisionMake') }}</h1>
                    @if ($errors->any())
                    <div class="alert alert-danger bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <ul class="block text-sm font-medium text-red-600 dark:text-red-300">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form class="space-y-4" action="{{ route('decisions.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="decision_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.decisionName') . " " . $period}}
                            </label>
                            <label for="machinetype_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.buyMachinetype')}}
                            </label>
                            @foreach ($machinetypes as $machinetype)
                            <div class="flex items-center">
                                <input type="radio" name="machinetype_id" id="machinetype_{{ $machinetype->id }}" value="{{ $machinetype->id }}" class="mr-2">

                                <label for="buy_{{ $machinetype->id }}" class="text-gray-800 dark:text-gray-200">
                                    {{ $machinetype->name }} {{ __('messages.selectAmount') }}
                                </label>

                                <input type="number"
                                    name="buy[{{ $machinetype->id }}]"
                                    id="buy_{{ $machinetype->id }}"
                                    min="0" max="3" value="0" step="1"
                                    class="border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200 transition duration-300 ease-in-out transform hover:scale-105">
                            </div>
                            @endforeach
                            <label for="sell" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.sellMachine')}}
                            </label>
                            @foreach ($machines as $machine)
                            <div class="flex items-center mb-2">
                                <input
                                    type="checkbox"
                                    name="sell[]"
                                    id="sell_{{ $machine->id }}"
                                    value="{{ $machine->id }}"
                                    class="mr-2">

                                <label for="sell_{{ $machine->id }}" class="text-gray-800 dark:text-gray-200">
                                    {{ $machine->type }} {{ $machine->id }}
                                </label>
                            </div>
                            @endforeach
                            <input type="hidden" name="player_id" id="player_id" value="{{$player->id}}" required>
                            <input type="hidden" name="period" id="period" value="{{$period}}" required>
                            <br>
                            <label for="approve" class="block text-sm font-medium text-red-700 dark:text-red-300">
                                {{ __('messages.decisionApprove') }}
                            </label>
                            <input type="checkbox" name="approve" id="approve" required class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded checked:bg-red-500">
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                {{ __('messages.create') }}
                            </button>
                        </div>
                    </form>
                    <div>
                        @foreach ($decisions as $decision)
                        <li class="ml-10">
                            {{ __('messages.decisionName') . " " . $decision->period}}
                            <a href="{{ route('decisions.show', $decision->id) }}" class="inline-flex items-center px-2 py-1 border border-transparent rounded-md font-semibold font-medium text-gray-700 dark:text-gray-300 tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                {{ __('messages.show') }}
                            </a>
                        </li>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>