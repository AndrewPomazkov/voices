<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * gain (усиление или ослабление амплитуды сигнала после нормализации, в децибелах, например, -20 - 20)
 */
class NormRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $params = explode(' ', $value);

        if (count($params) != 1) {
            return false;
        }

        // Проверяем допустимость значения параметра gain
        if (!is_numeric($params[0]) || floatval($params[0]) < -20 || floatval($params[0]) > 20) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Norm effect.';
    }
}
