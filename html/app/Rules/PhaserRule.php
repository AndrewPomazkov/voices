<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * gain-in (0.0 - 1.0)
 * gain-out (0.0 - 1.0)
 * delay (0 - 5 millisecond)
 * decay (0.0 - 1.0)
 * speed (0.1 - 10Hz)
 * -s или -t (optional: sinusoidal OR triangular)
 */
class PhaserRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $params = explode(' ', $value);

        if (count($params) < 5 || count($params) > 6) {
            return false;
        }

        // Проверяем допустимость значений параметров
        if (!is_numeric($params[0]) || floatval($params[0]) < 0 || floatval($params[0]) > 1) {
            return false;
        }

        if (!is_numeric($params[1]) || floatval($params[1]) < 0 || floatval($params[1]) > 1) {
            return false;
        }

        if (!is_numeric($params[2]) || floatval($params[2]) < 0 || floatval($params[2]) > 5) {
            return false;
        }

        if (!is_numeric($params[3]) || floatval($params[3]) < 0 || floatval($params[3]) > 1) {
            return false;
        }

        if (!is_numeric($params[4]) || floatval($params[4]) < 0.1 || floatval($params[4]) > 10) {
            return false;
        }

        if (count($params) == 6 && $params[5] != '-s' && $params[5] != '-t') {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Phaser effect.';
    }
}
