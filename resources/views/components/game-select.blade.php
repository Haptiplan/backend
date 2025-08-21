@props(['games', 'selected' => null, 'name' => 'game_id'])

<div class="space-y-2">
    @foreach ($games as $game)
        <div class="flex items-center">
            <input type="radio" name="{{ $name }}" id="game-{{ $game->id }}" value="{{ $game->id }}"
                class="mr-2"
                @if ($selected == $game->id) checked="checked" @endif>
            <label for="game-{{ $game->id }}" class="text-gray-800 dark:text-gray-200">{{ $game->name }}</label>
        </div>
    @endforeach
</div>