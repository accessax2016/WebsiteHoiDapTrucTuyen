<?php

namespace App\Http\Resources\Question;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionRelated extends JsonResource
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
            'voted' => $this->countVote($this->votes),
            'answered' => $this->answers->count() > 0 ? true : false,
            'best_answer' => $this->answers->where('best_answer', true)->count() > 0 ? true : false,
        ];
    }

    public function countVote($votes) {
        $countvotes_up = $votes->where('vote_action', 'up')->count();
        $countvotes_down = $votes->where('vote_action', 'down')->count();
        return $countvotes_up - $countvotes_down;
    }
}
