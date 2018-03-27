<?php

namespace App\Http\Resources\Question;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Tag\TagList;
use App\Http\Resources\User\UserInteract;

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
            'tags' => TagList::collection($this->tags),
            'best_answer' => $this->bestAnswer($this->answers),
            'user_last_interact' => $this->userLastInteract($this->answers), 
        ];
    }

    public function userLastInteract($answers) {
        if ($answers->count()) {
            $answers = $this->answers;
            $last_answer = $answers->where('updated_at', $answers->max('updated_at'))->last();
            $resource = $last_answer->user;
            $resource['interact'] = 'đã trả lời';
            $resource['date_interact'] = $last_answer->updated_at;
            return new UserInteract($resource);
        }
        else {
            $resource = $this->user;
            $resource['interact'] = 'đã hỏi';
            $resource['date_interact'] = $this->updated_at;
            return new UserInteract($resource);
        }
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
