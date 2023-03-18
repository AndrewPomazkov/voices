<?php
declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TimeScaleRule implements Rule
{
    private float $minFactor = 0.1; // Минимальное значение для коэффициента factor
    private int $maxFactor = 10;  // Максимальное значение для коэффициента factor

    public function passes($attribute, $value): bool
    {
        // Проверяем допустимость значения параметра factor
        if (!is_numeric($value) || floatval($value) < $this->minFactor || floatval($value) > $this->maxFactor) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute has an invalid parameter set for the TimeScale effect. The factor should be between ' . $this->minFactor . ' and ' . $this->maxFactor . '.';
    }
}
