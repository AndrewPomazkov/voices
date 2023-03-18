<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StatRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $params = explode(' ', $value);

        // Проверяем наличие недопустимых параметров
        foreach ($params as $param) {
            if ($param !== '-v' && $param !== '-d') {
                return false;
            }
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Stat effect.';
    }
}
