<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * длительность (положительное число, длительность синтезированного звука в секундах)
 * тип синтеза (одно из значений: sine, square, triangle, sawtooth, trapezium, exp, white, pink, brown, pluck)
 * частота (положительное число, основная частота синтезированного звука в герцах)
 */
class SynthRule implements Rule
{
    protected array $allowedTypes = [
        'sine', 'square', 'triangle', 'sawtooth', 'trapezium', 'exp',
        'white', 'pink', 'brown', 'pluck'
    ];

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

        // Проверяем допустимость значения длительности
        if (!is_numeric($params[0]) || floatval($params[0]) <= 0) {
            return false;
        }

        // Проверяем допустимость значения типа синтеза
        if (!in_array($params[1], $this->allowedTypes)) {
            return false;
        }

        // Проверяем допустимость значения частоты
        if (!is_numeric($params[2]) || floatval($params[2]) <= 0) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Synth effect.';
    }
}
