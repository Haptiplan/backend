
    <select name="period" id="periods" {{ $attributes }}
        class="rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-3 pr-8 py-2 focus:ring-indigo-500 focus:border-indigo-500 shadow w-auto"
    >
        @for ($i = 0; $i <= $maxPeriod; $i++)
            <option value="{{ $i }}" @if(isset($selected) && $selected == $i) selected @endif>{{ $i }}</option>
        @endfor
    </select>