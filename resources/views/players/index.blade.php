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
                    <h1 class="text-2xl font-bold mb-6">{{ __('messages.playerCreate') }}</h1>
                    @if ($errors->any())
                    <div class="alert alert-danger bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <ul class="block text-sm font-medium text-red-600 dark:text-red-300">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <a href="{{ route('players.create') }}" class="inline-flex items-center px-2 py-1 border border-transparent rounded-md font-semibold font-medium text-gray-700 dark:text-gray-300 tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                        {{ __('messages.playerCreate') }}
                    </a>
                    <div>
                        @foreach ($games as $game)
                        <label class="font-bold mb-6 mt-6"><u>{{ $game->name }}:</u> </label>
                        <br>
                        @foreach ($companies as $company)
                        @if ($game->id == $company->game_id)

                        <label class="mb-6 ml-10">{{ $company->name }}:</label>
                        <br>
                        @foreach($players as $player)
                        @foreach($user_list as $user)
                        @if ($player->id == $user->id && $player->company_id == $company->id)
                        <li class="mb-6 ml-20">
                            {{$user->name}}
                            <a href="{{ route('players.edit', $user->id) }}" class="inline-flex items-center px-2 py-1 border border-transparent rounded-md font-semibold font-medium text-gray-700 dark:text-gray-300 tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                {{ __('messages.edit') }}
                            </a>
                            <form action="{{ route('players.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-2 py-1 border border-transparent rounded-md font-semibold font-medium text-gray-700 dark:text-gray-300 tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                    {{ __('messages.delete') }}
                                </button>
                            </form>
                        </li>
                        @endif
                        @endforeach
                        @endforeach
                        @endif

                        @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>