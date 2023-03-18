<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 *
 * gain (усиление в децибелах, например, 0 - 100)
 * colour (цветность, например, 20 - 20000 Гц)
 *
 */

class DistortionRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $params = explode(' ', $value);

        if (count($params) != 2) {
            return false;
        }

        // Проверяем допустимость значений параметров
        if (!is_numeric($params[0]) || floatval($params[0]) < 0 || floatval($params[0]) > 100) {
            return false;
        }

        if (!is_numeric($params[1]) || floatval($params[1]) < 20 || floatval($params[1]) > 20000) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Distortion effect.';
    }
}
