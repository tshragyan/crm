<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ImageRule implements ValidationRule
{
    const MIN_HEIGHT = 100;
    const MIN_WIDTH = 100;

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $pass = false;
        if ($value) {
            $imageInfo = getimagesize($value->getPathname());

            if ($imageInfo !== false) {
                $width = $imageInfo[0];
                $height = $imageInfo[1];

                $pass =  $width >= self::MIN_WIDTH && $height >= self::MIN_HEIGHT;
            }

            if (!$pass) {
                $fail("The :attribute must be at least " . self::MIN_WIDTH ."x" . self::MIN_HEIGHT . " pixels.");
            }
        }
    }
}
