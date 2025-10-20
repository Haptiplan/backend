@props(['statusOrder', 'selected'])

<select name="status" class="rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3 pr-8 py-2 focus:ring-indigo-500 focus:border-indigo-500 shadow w-auto" {{ $attributes->merge(['class' => 'border rounded p-1 text-sm']) }}>
    @foreach ($statusOrder as $statusOption)
        <option value="{{ $statusOption }}" @if($selected === $statusOption) selected @endif>
            {{ ucfirst($statusOption) }}
        </option>
    @endforeach
</select>