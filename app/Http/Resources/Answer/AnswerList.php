<?php

namespace App\Http\Resources\Answer;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserOwner;
use App\Http\Resources\Comment\CommentList;

class AnswerList extends JsonResource
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
            'voted' => $this->countVote($this->votes),
            'best_answer' => $this->best_answer,
            'date_answer' => $this->created_at,
            'user_owner' => new UserOwner($this->user),
            'comments' => CommentList::collection($this->comments),
        ];
    }

    public function countVote($votes) {
        $countvotes_up = $votes->where('vote_action', 'up')->count();
        $countvotes_down = $votes->where('vote_action', 'down')->count();
        return $countvotes_up - $countvotes_down;
    }
}
