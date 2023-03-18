<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * gain-in (increase input signal , 0.0 - 1.0)
 * gain-out (Increase output signal, 0.0 - 1.0)
 * delay (delay in seconds, 0.1 - 5.0)
 * decay (echo decay 0.0 - 1.0)
 */
class EchoRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $params = explode(' ', $value);

        if (count($params) != 4) {
            return false;
        }

        // Проверяем допустимость значений параметров
        if (!is_numeric($params[0]) || floatval($params[0]) < 0 || floatval($params[0]) > 1) {
            return false;
        }

        if (!is_numeric($params[1]) || floatval($params[1]) < 0 || floatval($params[1]) > 1) {
            return false;
        }

        if (!is_numeric($params[2]) || floatval($params[2]) < 0.1 || floatval($params[2]) > 5) {
            return false;
        }

        if (!is_numeric($params[3]) || floatval($params[3]) < 0 || floatval($params[3]) > 1) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Echo effect.';
    }
}
