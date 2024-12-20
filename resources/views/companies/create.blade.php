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
                    <h1 class="text-2xl font-bold mb-6">{{ __('messages.companyCreate') }}</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <ul class="block text-sm font-medium text-red-600 dark:text-red-300">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <x-success-message></x-success-message>
                    <form class="space-y-4" action="{{ route('companies.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.companyName') }}
                            </label>
                            <input type="text" name="company_name" id="company_name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.game') }}
                            </label>
                            @foreach ($games as $game)
                            <input type="radio" name="game_id" id="{{$game->id}}" value="{{$game->id}}">
                            <label for="{{$game->id}}">{{$game->name}}</label><br>
                            @endforeach
                        </div>
                        <div>
                            <x-submit-button>{{ __('messages.create') }}</x-submit-button>
                        </div>
                    </form> 
                    <x-back-button href="{{ route('companies.index') }}"></x-back-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
