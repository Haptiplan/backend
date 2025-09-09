@props(['companies', 'selected' => null, 'name' => 'company_id'])

<div class="space-y-4">
    @foreach ($companies as $company)
        <div class="flex items-center space-x-4 mb-4">
            <input
                type="radio"
                name="{{ $name }}"
                id="{{ $name }}_{{ $company->id }}"
                value="{{ $company->id }}"
                class="h-5 w-5 text-blue-600 border-gray-300 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:focus:ring-blue-500 dark:text-blue-600"
                @if($selected == $company->id) checked @endif
            >
            <label for="{{ $name }}_{{ $company->id }}"
                class="text-lg text-gray-800 dark:text-gray-300 font-medium">
                {{ $company->name }}
            </label>
        </div>
    @endforeach
</div>