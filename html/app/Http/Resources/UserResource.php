<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if(Auth::guest() || $request->user()->role !== 'admin') {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'avatar' => $this->avatar
            ];
        }

        return parent::toArray($request);
    }
}
