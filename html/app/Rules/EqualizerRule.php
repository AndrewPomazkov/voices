<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EqualizerRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $params = explode(' ', $value);

        if (count($params) != 3) {
            return false;
        }

        // Проверяем допустимость значений параметров
        if (!is_numeric($params[0]) || floatval($params[0]) < 100 || floatval($params[0]) > 16000) {
            return false;
        }

        if (!is_numeric($params[1]) || floatval($params[1]) < 0.1 || floatval($params[1]) > 10) {
            return false;
        }

        if (!is_numeric($params[2]) || floatval($params[2]) < -20 || floatval($params[2]) > 20) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Equalizer effect.';
    }
}
