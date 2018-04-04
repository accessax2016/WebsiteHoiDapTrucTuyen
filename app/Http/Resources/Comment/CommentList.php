<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserOwner;

class CommentList extends JsonResource
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
            'content' => $this->content,
            'date_comment' => $this->created_at,
            'user' => new UserOwner($this->user),
        ];
    }
}
