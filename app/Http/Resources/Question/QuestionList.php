<?php

namespace App\Http\Resources\Question;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Tag\TagTagged;
use App\Http\Resources\Activity\ActityInteract;

class QuestionList extends JsonResource
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
            'viewed' => $this->view,
            'answered' => $this->answers->count(),
            'voted' => $this->countVote($this->votes),
            'tags' => TagTagged::collection($this->tags),
            'best_answer' => $this->bestAnswer($this->answers),
            'user_last_interact' => new ActityInteract($this->activities->last()), 
        ];
    }

    public function bestAnswer($answers) {
        if ($answers->where('best_answer', true)->count()) {
            return true;
        }
        else {
            return false;
        }
    }

    public function countVote($votes) {
        $countvotes_up = $votes->where('vote_action', 'up')->count();
        $countvotes_down = $votes->where('vote_action', 'down')->count();
        return $countvotes_up - $countvotes_down;
    }
}
