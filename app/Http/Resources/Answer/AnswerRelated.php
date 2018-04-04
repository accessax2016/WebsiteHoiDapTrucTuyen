<?php

namespace App\Http\Resources\Answer;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerRelated extends JsonResource
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
            'title' => $this->title,
            'title_url' => $this->title_url,
            'voted' => $this->voted,
            'answered' => $this->answers->count() > 0 ? true : false,
            'best_answer' => $this->answers->where('best_answer', true)->count() > 0 ? true : false,
        ];
    }
}
