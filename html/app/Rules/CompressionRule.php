<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CompressionRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $params = explode(' ', $value);

        if (count($params) != 5) {
            return false;
        }

        // Проверяем допустимость значений параметров
        if (!is_numeric($params[0]) || floatval($params[0]) < 0.1 || floatval($params[0]) > 500) {
            return false;
        }

        if (!is_numeric($params[1]) || floatval($params[1]) < 0.1 || floatval($params[1]) > 5000) {
            return false;
        }

        if (!is_numeric($params[2]) || floatval($params[2]) < -90 || floatval($params[2]) > 0) {
            return false;
        }

        // Проверяем соотношение
        $ratio_parts = explode(':', $params[3]);
        if (count($ratio_parts) != 2 || !ctype_digit($ratio_parts[0]) || !ctype_digit($ratio_parts[1]) ||
            intval($ratio_parts[0]) < 1 || intval($ratio_parts[0]) > 100 ||
            intval($ratio_parts[1]) < 1 || intval($ratio_parts[1]) > 100 ||
            intval($ratio_parts[0]) > intval($ratio_parts[1])) {
            return false;
        }

        if (!is_numeric($params[4]) || floatval($params[4]) < 0 || floatval($params[4]) > 30) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Compression effect.';
    }
}
