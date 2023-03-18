<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Vol эффект контролирует громкость аудиофайла.
 * gain (число, изменение уровня громкости в децибелах, может быть положительным или отрицательным)
 * scale (необязательное, число, множитель для уровня громкости, от 0 до бесконечности)
 */
class VolRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $params = explode(' ', $value);

        if (count($params) < 1 || count($params) > 2) {
            return false;
        }

        // Проверяем допустимость значения параметра gain
        if (!is_numeric($params[0])) {
            return false;
        }

        // Проверяем допустимость значения параметра scale, если он представлен
        if (count($params) == 2 && (!is_numeric($params[1]) || floatval($params[1]) <= 0)) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Vol effect.';
    }
}
