<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserList extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'name_url' => $this->name_url,
            'avatar' => $this->avatar,
            'location' => $this->location,
            'point' => $this->point_reputation,
            'date' => $this->created_at,
        ];
    }
}
