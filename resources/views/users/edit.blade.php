<?php
    use App\Models\User;
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.userEdit') }}
        </h2>
    </x-slot>

   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">{{ __('messages.userEdit') }}</h1>
                    <form class="space-y-4" action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('messages.username') }}
                            </label>
                            <input type="text" name="name" id="name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200" value="{{ $user->name }}">
                            
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('messages.email') }}
                            </label>
                            <input type="email" name="email" id="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200" value="{{ $user->email }}">

                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">
                                {{ __('messages.role') }}
                            </label>
                            <input type="radio" name="role" id="{{User::ROLE_ADMIN}}" value="{{User::ROLE_ADMIN}}">
                            <label for="{{User::ROLE_ADMIN}}">{{ __('messages.admin') }}</label><br>
                            <input type="radio" name="role" id="{{User::ROLE_GAMEMASTER}}" value="{{User::ROLE_GAMEMASTER}}">
                            <label for="{{User::ROLE_GAMEMASTER}}">{{ __('messages.gamemaster') }}</label><br>
                            <input type="radio" name="role" id="{{User::ROLE_USER}}" value="{{User::ROLE_USER}}">
                            <label for="{{User::ROLE_USER}}">{{ __('messages.player') }}</label><br>
                       
                            @if ($user->role == User::ROLE_GAMEMASTER)
                            <label for="game" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">
                                {{ __('messages.chooseGame') }}
                            </label>
                            @foreach ($games_free as $game)
                            <input type="radio" name="game" id="{{$game->id}}" value="{{$game->id}}">
                            <label for="{{$game->id}}">{{$game->name}}</label><br>
                            @endforeach
                            @endif
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                {{ __('messages.submit') }}
                            </button>
                    </form> 
                    <a href="{{ route('users.index') }}" class="inline-flex items-center px-2 py-1 border border-transparent rounded-md font-semibold font-medium text-gray-700 dark:text-gray-300 tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                        {{ __('messages.back') }}
                    </a>
                    @if ($user->role == User::ROLE_GAMEMASTER)
                    <label for="game" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">
                        {{ __('messages.listGames') }}:
                    </label>
                    @foreach ($gamemasters as $gamemaster)
                    <li>
                        @foreach ($games_used as $game)
                        @if (isset($gamemaster) && $gamemaster->game_id == $game->id)
                            {{$game->name}}
                        @endif
                        @endforeach
                    </li>
                    @endforeach
                    @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
