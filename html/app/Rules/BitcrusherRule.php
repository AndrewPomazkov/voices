<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BitcrusherRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        // Разделяем строку параметров на массив чисел
        $params = explode(' ', $value);

        // Проверяем количество параметров
        if (count($params) != 2) {
            return false;
        }

        // Проверяем, является ли первый параметр целым числом (глубина бита)
        if (!ctype_digit($params[0])) {
            return false;
        }

        // Проверяем допустимость глубины бита (обычно от 1 до 24)
        $bitDepth = intval($params[0]);
        if ($bitDepth < 1 || $bitDepth > 24) {
            return false;
        }

        // Проверяем, является ли второй параметр действительным числом (уменьшение частоты дискретизации)
        if (!is_numeric($params[1])) {
            return false;
        }

        // Проверяем допустимость уменьшения частоты дискретизации (обычно от 0.1 до 1.0)
        $sampleRateReduction = floatval($params[1]);
        if ($sampleRateReduction < 0.1 || $sampleRateReduction > 1.0) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Bitcrusher effect.';
    }
}
