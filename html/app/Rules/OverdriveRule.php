<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * gain (усиление или ослабление амплитуды сигнала перед насыщением, в децибелах, например, -20 - 20)
 * color (коэффициент насыщения, от 0 до 100)
 */
class OverdriveRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $params = explode(' ', $value);

        if (count($params) != 2) {
            return false;
        }

        // Проверяем допустимость значения параметра gain
        if (!is_numeric($params[0]) || floatval($params[0]) < -20 || floatval($params[0]) > 20) {
            return false;
        }

        // Проверяем допустимость значения параметра color
        if (!is_numeric($params[1]) || floatval($params[1]) < 0 || floatval($params[1]) > 100) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Overdrive effect.';
    }
}
