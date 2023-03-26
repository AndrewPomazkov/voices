<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\AudioEffects;
use Illuminate\Http\Resources\Json\JsonResource;

class AudioResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'path' => $this->path,
            'imiages' => new AudioImageResource($this->whenLoaded('images')),
            'filename' => $this->filename,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'audio_effects' => AudioEffectResource::collection($this->audioEffects),
        ];
    }
}
