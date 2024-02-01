<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ImageExist implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $files = explode(',' , $value);        
        
        foreach ($files as $file) {
            if (!file_exists($file)) {
                $fail('فایل ها بارگزاری نشده اند.');
            }
        }
    }
}
