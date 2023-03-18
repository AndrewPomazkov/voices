<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * gain (усиление или ослабление амплитуды сигнала, в децибелах, например, -20 - 20)
 * normalization (необязательный, "n" - не нормализовать, "e" - нормализовать по пиковому уровню, "p" - нормализовать по среднеквадратичному уровню)
 */
class GainRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $params = explode(' ', $value);

        if (count($params) < 1 || count($params) > 2) {
            return false;
        }

        // Проверяем допустимость значений параметров
        if (!is_numeric($params[0]) || floatval($params[0]) < -20 || floatval($params[0]) > 20) {
            return false;
        }

        if (isset($params[1]) && $params[1] != 'n' && $params[1] != 'e' && $params[1] != 'p') {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Gain effect.';
    }
}
