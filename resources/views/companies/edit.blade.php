<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.companyEdit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-semibold text-center mb-8 text-gray-900 dark:text-gray-100">{{ __('messages.companyEdit') }}</h1>

                    <!-- Error Alert -->
                    @if ($errors->any())
                        <div class="alert alert-danger bg-red-100 dark:bg-red-800 border-l-4 border-red-500 p-4 mb-6 rounded-md">
                            <ul class="block text-sm font-medium text-red-600 dark:text-red-300">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Edit Company Form -->
                    <form class="space-y-8" action="{{ route('companies.update', $company->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Company Name Input -->
                        <div class="space-y-4">
                            <label for="company_name" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.companyName') }}
                            </label>
                            <input type="text" name="company_name" id="company_name" required class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200 transition duration-300 ease-in-out transform hover:scale-105" value="{{ $company->name }}">
                        </div>

                        <!-- Game Selection -->
                        <div class="space-y-4">
                            <label class="b

</x-app-layout>
