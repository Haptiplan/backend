<?php

namespace App\Rules;

use App\Models\MachineType;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class MachineTypeUsedInGame implements ValidationRule
{
    protected $machine_type_name;
    protected $game_id;
    public function __construct($machine_type_name, $game_id)
    {
        $this->machine_type_name = $machine_type_name;
        $this->game_id = $game_id;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if a machine type already exists with the same name and game_id
        $machineType = MachineType::where('name', $this->machine_type_name)
            ->where('game_id', $this->game_id)
            ->count();
        $exists = $machineType > 1 ? true : false;

        if ($exists) {
            // If it exists, fail the validation with a custom message
            $fail(__('validation.machineTypeUsedInGame'));
        }
    }
}
