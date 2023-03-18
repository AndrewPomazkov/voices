<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioEffectList extends Model
{
    use HasFactory;

    protected $fillable = [
        'effect_name',
        'effect_parameters',
        'effect_title',
        'effect_description',
    ];

    protected $primaryKey = 'id';

    /**
     * Мутатор для преобразования атрибута `effect_parameters` в JSON-строку перед сохранением в базу данных.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setEffectParametersAttribute(mixed $value): void
    {
        $this->attributes['effect_parameters'] = json_encode($value);
    }

    /**
     * Аксессор для преобразования атрибута `effect_parameters` из JSON-строки при получении из базы данных.
     *
     * @param  mixed  $value
     * @return array|null
     */
    public function getEffectParametersAttribute(mixed $value): ?array
    {
        return $value ? json_decode($value, true) : null;
    }
}
