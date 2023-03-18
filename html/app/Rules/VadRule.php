<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Vad эффект применяет алгоритм обнаружения активности голоса (Voice Activity Detection) к аудиофайлу.
 * На данный момент нет параметров, которые нужно проверить для данного эффекта.
 */

/**
 * Пример строки параметров для этого эффекта:
 * "0.00001 0.0001"
 *
 * параметры:
 * - окно анализа в секундах (от 0.0001 до 1)
 * - пороговое значение в децибелах (от -100 до 0)
 */
class VadRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $params = explode(' ', $value);

        if (count($params) != 2) {
            return false;
        }

        // Проверяем допустимость значения параметра window
        if (!is_numeric($params[0]) || floatval($params[0]) < 0.0001 || floatval($params[0]) > 1) {
            return false;
        }

        // Проверяем допустимость значения параметра threshold
        if (!is_numeric($params[1]) || floatval($params[1]) < -100 || floatval($params[1]) > 0) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Vad effect.';
    }
}
