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
                    <h1 class="text-2xl font-bold mb-6">{{ __('messages.companyIndex') }}</h1>
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

                    <x-create-button href="{{ route('companies.create') }}">{{ __('messages.companyCreate') }}</x-create-button>
                    
                    <div>
                    @foreach ($games as $game)
                        <label class="font-bold mb-6"><u>{{$game->name}}:</u></label> <br>
                        @foreach($companies as $company)
                            @if ($game->id == $company->game_id)
                    
                                <li class="ml-10">
                                    {{$company->name}}
                                    <x-edit-button href="{{ route('companies.edit', $company->id) }}"></x-edit-button>
                                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-delete-button></x-delete-button>
                                    </form>
                                </li>
                            @endif
                        @endforeach
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
