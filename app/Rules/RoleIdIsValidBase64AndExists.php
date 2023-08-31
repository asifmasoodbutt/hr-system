<?php

namespace App\Rules;

use App\Models\Role;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RoleIdIsValidBase64AndExists implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
         // Check if the input is a valid base64 encoded string
         $decodedRoleId = base64_decode($value, true);
         if ($decodedRoleId) {
             $decodedRoleId = (int) $decodedRoleId;
             // Perform exists validation in the database
             $exists = Role::where('id', $decodedRoleId)->exists();
             if (!$exists) {
                 $fail('The selected :attribute is invalid.');
             }
         } else {
             $fail('The :attribute must be a valid base64 encoded string.');
         }
    }
}
