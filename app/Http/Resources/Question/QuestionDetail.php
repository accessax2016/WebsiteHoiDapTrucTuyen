<?php

namespace App\Http\Resources\Question;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Tag\TagTagged;
use App\Http\Resources\User\UserOwner;
use App\Http\Resources\Comment\CommentList;
use Auth;
use App\Http\Resources\Vote\VoteResource;

class QuestionDetail extends JsonResource
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
            'content' => $this->content,
            'date' => $this->created_at,
            'viewed' => $this->view,
            'answered' => $this->answers->count(),
            'best_answer' => $this->bestAnswer($this->answers),
            'voted' => $this->countVote($this->votes),
            'current_user_voted' => new VoteResource($this->currentUserVoted($this->votes)),
            'tags' => TagTagged::collection($this->tags),
            'user_owner' => new UserOwner($this->user),
            'comments' => CommentList::collection($this->comments),
        ];
    }

    public function countVote($votes) {
        $countvotes_up = $votes->where('vote_action', 'up')->count();
        $countvotes_down = $votes->where('vote_action', 'down')->count();
        return $countvotes_up - $countvotes_down;
    }

    public function bestAnswer($answers) {
        if ($answers->where('best_answer', true)->count()) {
            return true;
        }
        else {
            return false;
        }
    }

    public function currentUserVoted($votes) {
        $user = Auth::guard('api')->user();
        if ($user) {
            return $votes->where('user_id', $user->id)->last();
        }
        return null;
    }
}
