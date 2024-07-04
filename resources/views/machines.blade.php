<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <h1 class="text-2xl font-bold mb-6>Machine List</h1>
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Machines:</h1>
                    <div class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        @foreach($machines as $machine)
                             <li>{{$machine->machineName }}</li>
                         @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
