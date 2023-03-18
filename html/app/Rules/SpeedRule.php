<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * factor (коэффициент изменения скорости воспроизведения, положительное число)
 */
class SpeedRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $params = explode(' ', $value);

        if (count($params) != 1) {
            return false;
        }

        // Проверяем допустимость значения параметра factor
        if (!is_numeric($params[0]) || floatval($params[0]) <= 0) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Speed effect.';
    }
}
