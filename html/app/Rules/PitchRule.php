<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * cents (смещение высоты тона в центах, от -1200 до 1200)
 */

class PitchRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $params = explode(' ', $value);

        if (count($params) != 1) {
            return false;
        }

        // Проверяем допустимость значения параметра cents
        if (!is_numeric($params[0]) || floatval($params[0]) < -1200 || floatval($params[0]) > 1200) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Pitch effect.';
    }
}
