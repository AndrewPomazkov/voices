<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * reverberance (процент обратной связи или "послезвучия", от 0 до 100)
 * hf_damping (процент затухания высоких частот, от 0 до 100)
 * room_scale (размер комнаты, как процент от максимального размера, от 0 до 100)
 * stereo_depth (глубина стереоэффекта, в процентах, от 0 до 100)
 * pre_delay (задержка перед началом реверберации, в миллисекундах, от 0 до 200)
 * wet_gain (усиление или ослабление "влажного" (обработанного) сигнала, в децибелах, от -20 до 10)
 * dry_gain (усиление или ослабление "сухого" (необработанного) сигнала, в децибелах, от -20 до 10)
 */
class ReverbRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $params = explode(' ', $value);

        if (count($params) != 7) {
            return false;
        }

        // Проверяем допустимость значения параметра reverberance
        if (!is_numeric($params[0]) || floatval($params[0]) < 0 || floatval($params[0]) > 100) {
            return false;
        }

        // Проверяем допустимость значения параметра hf_damping
        if (!is_numeric($params[1]) || floatval($params[1]) < 0 || floatval($params[1]) > 100) {
            return false;
        }

        // Проверяем допустимость значения параметра room_scale
        if (!is_numeric($params[2]) || floatval($params[2]) < 0 || floatval($params[2]) > 100) {
            return false;
        }

        // Проверяем допустимость значения параметра stereo_depth
        if (!is_numeric($params[3]) || floatval($params[3]) < 0 || floatval($params[3]) > 100) {
            return false;
        }

        // Проверяем допустимость значения параметра pre_delay
        if (!is_numeric($params[4]) || floatval($params[4]) < 0 || floatval($params[4]) > 200) {
            return false;
        }

        // Проверяем допустимость значения параметра wet_gain
        if (!is_numeric($params[5]) || floatval($params[5]) < -20 || floatval($params[5]) > 10) {
            return false;
        }

        // Проверяем допустимость значения параметра dry_gain
        if (!is_numeric($params[6]) || floatval($params[6]) < -20 || floatval($params[6]) > 10) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the Reverb effect.';
    }
}
