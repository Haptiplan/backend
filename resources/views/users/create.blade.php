<?php

use App\Models\User; ?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 dark:from-gray-800 dark:to-gray-900 shadow-xl sm:rounded-lg">
                <div class="p-8 text-white">
                    <h1 class="text-3xl font-extrabold mb-8">{{ __('messages.userCreate') }}</h1>
                    <form class="space-y-6" action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <!-- Username -->
                        <div>
                            <label for="name" class="block text-lg font-medium mb-2">
                                {{ __('messages.username') }}
                            </label>
                            <input type="text" name="name" id="name" required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm
                               focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-lg font-medium mb-2">
                                {{ __('messages.email') }}
                            </label>
                            <input type="email" name="email" id="email" required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm
                               focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-lg font-medium mb-2">
                                {{ __('messages.password') }}
                            </label>
                            <input type="password" name="password" id="password" required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm
                               focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <!-- Roles -->
                        <div>
                            <label for="role" class="block text-lg font-medium mb-4">
                                {{ __('messages.role') }}
                            </label>
                            <div class="space-y-2">
                                @foreach($roles as $role)
                                    <div class="flex items-center space-x-3">
                                        <input type="radio" name="role" id="role_{{ $role->id }}" value="{{ $role->id }}" required
                                               class="w-5 h-5 text-indigo-600 focus:ring-indigo-500">
                                        <label for="role_{{ $role->id }}" class="text-lg">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                    class="w-full bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-3 px-6 rounded-lg shadow-lg
                                transition-transform transform hover:scale-105">
                                {{ __('messages.create') }}
                            </button>
                        </div>
                    </form>

                    <!-- Back Button -->
                    <div class="mt-6">
                        <x-back-button href="{{ route('users.index') }}"
                                       class="w-full bg-gray-700 hover:bg-gray-800 text-white font-bold py-3 px-6 rounded-lg shadow-lg
                                   transition-transform transform hover:scale-105">
                            {{ __('messages.back') }}
                        </x-back-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
