<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ExperiencesRequiredIfRule implements ValidationRule
{
    private $pay_scale_id;

    public function __construct($pay_scale_id)
    {
        $this->pay_scale_id = $pay_scale_id;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->pay_scale_id != 1  && empty($value)) {
            $fail('The experiences field is required when employee is not of Entry Level.');
        }
    }
}
