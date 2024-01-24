<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxStringSize implements ValidationRule
{
    public function __construct(protected int $size) {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strlen($value) > $this->size) {
            $fail('The :attribute must be less than ' . $this->size . ' byte.');
        }
    }
}
