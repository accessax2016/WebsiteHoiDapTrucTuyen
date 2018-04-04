<?php

namespace App\Http\Resources\Activity;

use Illuminate\Http\Resources\Json\JsonResource;

class ActityInteract extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'interact' => $this->content,
            'date_interact' => $this->created_at,
        ];
    }
}
