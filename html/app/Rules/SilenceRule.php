<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * above_periods (целое число, количество периодов непрерывной тишины превышающих threshold, прежде чем начать удалять)
 * duration (положительное число, минимальная продолжительность тишины, которую следует удалить в секундах)
 * threshold (положительное число, порог уровня звукового сигнала для определения тишины, в децибелах)
 */
class SilenceRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        // Проверяем тип данных входного значения
        if (!is_string($value)) {
            return false;
        }

        // Используем регулярное выражение для разделения параметров
        $params = preg_split('/\s+/', $value);

        if (count($params) != 3) {
            return false;
        }

        // Проверяем допустимость значения параметра above_periods
        if (!ctype_digit($params[0])) {
            return false;
        }

        // Проверяем допустимость значения параметра duration
        if (!is_numeric($params[1]) || floatval($params[1]) <= 0) {
            return false;
        }

        // Проверяем допустимость значения параметра threshold
        if (!is_numeric($params[2]) || floatval($params[2]) <= 0) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Silence effect.';
    }
}
