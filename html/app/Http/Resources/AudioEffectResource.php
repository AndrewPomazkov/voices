<?php

namespace App\Http\Resources;

use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AudioEffectResource extends JsonResource
{
    #[ArrayShape(['id' => "mixed", 'effect_id' => "mixed", 'filters' => "mixed"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'effect_id' => $this->effect_id,
            'filters' => json_decode($this->filters),
        ];
    }

    /**
     * Create new anonymous resource collection.
     *
     * @param  mixed  $resource
     */
    public static function collection(mixed $resource)
    {
        return new AnonymousResourceCollection($resource, get_called_class());
    }
}
