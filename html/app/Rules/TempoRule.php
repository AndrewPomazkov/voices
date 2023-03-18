<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
// unlikie  ??
class TempoRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        // Проверяем допустимость значения параметра
        if (!is_numeric($value) || floatval($value) < 0.5 || floatval($value) > 2.0) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter for the Tempo effect.';
    }
}
