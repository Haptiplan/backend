<?php

namespace App\Rules;

use App\Models\Company;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CompanyUsedInGame implements ValidationRule
{

    protected $company_name;
    protected $game_id;

    public function __construct($company_name, $game_id)
    {
        $this->company_name = $company_name;
        $this->game_id = $game_id;
    }
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if a company already exists with the same name and game_id
        $exists = Company::where('name', $this->company_name)
            ->where('game_id', $this->game_id)
            ->exists();

        if ($exists) {
            // If it exists, fail the validation with a custom message
            $fail(__('validation.companyUsedInGame'));
        }
    }
}
