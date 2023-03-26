<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AudioImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /**
         * title      varchar(255)    null,
        audio_id   bigint unsigned not null,
        image_url  varchar(255)    not null,
        views      int default 0   not null,
        likes      int default 0   not null,
        dislikes   int default 0   not null,
        id         bigint unsigned auto_increment
        primary key,
        created_at timestamp       null,
        updated_at timestamp       null,
        deleted_at
         */
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image_url' => $this->image_url,
            'views' => $this->views,
            'likes' => $this->likes,
            'dislikes' => $this->dislikes,
            // ... other attributes
        ];
    }
}
