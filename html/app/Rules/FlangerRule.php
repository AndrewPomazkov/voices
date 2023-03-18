<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * delay (базовая задержка в миллисекундах, например, 0 - 30)
 * depth (глубина модуляции задержки в миллисекундах, например, 0 - 10)
 * regen (регенерация или количество обратной связи, в децибелах, например, -95 - 95)
 * width (ширина комбинированного сигнала, в процентах, например, 0 - 100)
 * speed (скорость модуляции, в Герцах, например, 0.1 - 10)
 * shape (форма модуляции, "sine" или "triangle")
 */
class FlangerRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $params = explode(' ', $value);

        if (count($params) != 6) {
            return false;
        }

        // Проверяем допустимость значений параметров
        if (!is_numeric($params[0]) || floatval($params[0]) < 0 || floatval($params[0]) > 30) {
            return false;
        }

        if (!is_numeric($params[1]) || floatval($params[1]) < 0 || floatval($params[1]) > 10) {
            return false;
        }

        if (!is_numeric($params[2]) || floatval($params[2]) < -95 || floatval($params[2]) > 95) {
            return false;
        }

        if (!is_numeric($params[3]) || floatval($params[3]) < 0 || floatval($params[3]) > 100) {
            return false;
        }

        if (!is_numeric($params[4]) || floatval($params[4]) < 0.1 || floatval($params[4]) > 10) {
            return false;
        }

        if ($params[5] != 'sine' && $params[5] != 'triangle') {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Flanger effect.';
    }
}
