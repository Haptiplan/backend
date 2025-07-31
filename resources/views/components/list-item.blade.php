<li class="flex justify-between items-center bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700 rounded-lg p-4 shadow-lg transition-transform hover:scale-105 mb-4">
    <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $item->name }}</span>
    <div class="flex items-center space-x-2">
        
        <x-edit-button href="{{ route($editRoute, $item->id) }}" />
        <form action="{{ route($deleteRoute, $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
            @csrf
            @method('DELETE')
            <x-delete-button />
        </form>
    </div>
</li>