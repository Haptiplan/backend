@if (session('status'))
<div class="alert alert-success bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <ul class="block text-sm font-medium text-green-600 dark:text-green-300">
        <li>{{ __(session('status')) }}</li>
    </ul>
</div>
@endif