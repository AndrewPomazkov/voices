<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * attack (время атаки в миллисекундах, например, 0.1 - 1000)
 * release (время релиза (освобождения) в миллисекундах, например, 0.1 - 5000)
 * threshold (порог, при котором ограничение начинает действовать, в децибелах, например, -20 - 0)
 * gain (усиление или ослабление амплитуды сигнала, в децибелах, например, -20 - 20)
 */
class LimiterRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $params = explode(' ', $value);

        if (count($params) != 4) {
            return false;
        }

        // Проверяем допустимость значения параметра attack
        if (!is_numeric($params[0]) || floatval($params[0]) < 0.1 || floatval($params[0]) > 1000) {
            return false;
        }

        // Проверяем допустимость значения параметра release
        if (!is_numeric($params[1]) || floatval($params[1]) < 0.1 || floatval($params[1]) > 5000) {
            return false;
        }

        // Проверяем допустимость значения параметра threshold
        if (!is_numeric($params[2]) || floatval($params[2]) < -20 || floatval($params[2]) > 0) {
            return false;
        }

        // Проверяем допустимость значения параметра gain
        if (!is_numeric($params[3]) || floatval($params[3]) < -20 || floatval($params[3]) > 20) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Limiter effect.';
    }
}
