<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidBase64AndExists implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the input is a valid base64 encoded string
        $decodedEmployeeId = base64_decode($value, true);
        if ($decodedEmployeeId) {
            $decodedEmployeeId = (int) $decodedEmployeeId;
            // Perform exists validation in the database
            $exists = User::where('id', $decodedEmployeeId)->exists();
            if (!$exists) {
                $fail('The selected :attribute is invalid.');
            }
        } else {
            $fail('The :attribute must be a valid base64 encoded string.');
        }
    }
}
