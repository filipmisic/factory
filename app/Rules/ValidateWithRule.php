<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateWithRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $withs = explode(',',$value);
        $availableWiths = ['category','ingredients','tags'];

        if(count(array_diff($withs, $availableWiths)))
            $fail("Given parameter dose not exisit");
    }
}
