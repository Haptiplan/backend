<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.companyEdit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">{{ __('messages.companyEdit') }}</h1>
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
                    <form class="space-y-4" action="{{ route('company.update', $company->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.companyName') }}
                            </label>
                            <input type="text" name="company_name" id="company_name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200" value = {{ $company->name }}></input>
                            <select name="game_id" id="game_id" required class="mt-1 block w-full px-1 py-1 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                                <option value="" hidden>{{ __('messages.chooseGame') }}</option>
                                @foreach ($games as $game)
                                <option value="{{$game->id}}" @if($company->game_id == $game->id) selected @endif>{{$game->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                {{ __('messages.edit') }}
                            </button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
