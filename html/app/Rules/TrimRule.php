<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TrimRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        // Проверяем тип данных входного значения
        if (!is_string($value)) {
            return false;
        }

        // Используем регулярное выражение для разделения параметров
        $params = preg_split('/\s+/', $value);

        if (count($params) != 2) {
            return false;
        }

        // Проверяем допустимость значения параметра начального времени
        if (!is_numeric($params[0]) || floatval($params[0]) < 0) {
            return false;
        }

        // Проверяем допустимость значения параметра конечного времени
        if (!is_numeric($params[1]) || floatval($params[1]) <= 0 || floatval($params[1]) <= floatval($params[0])) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Trim effect.';
    }
}
