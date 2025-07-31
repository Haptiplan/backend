@if ($errors->any())
    <div class="bg-red-100 dark:bg-red-600 p-4 mb-6 rounded-md">
        <ul class="text-sm font-medium text-red-600 dark:text-red-300">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif