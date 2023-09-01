<?php

namespace App\Rules;

use App\Models\Tag;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateTagsRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $tags = explode(',',$value);
        if(count($tags)>5)
            $fail("select up to 5 tags ");
        if(Tag::query()->whereIn('id',$tags)->count() !== count(array_unique($tags)))
            $fail("One of the selected tags does not exist");
    }
}
