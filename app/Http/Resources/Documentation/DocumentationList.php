<?php

namespace App\Http\Resources\Documentation;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Tag\TagList;

class DocumentationList extends JsonResource
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
            'summary' => $this->title,
            'viewed' => $this->view,
            'voted' => $this->countVote($this->votes),
            'tags' => TagList::collection($this->tags),
            'user_last_interact' => $this->userLastInteract($this->user), 
        ];
    }

    public function countVote($votes) {
        $countvotes_up = $votes->where('vote_action', 'up')->count();
        $countvotes_down = $votes->where('vote_action', 'down')->count();
        return $countvotes_up - $countvotes_down;
    }

    public function userLastInteract($user) {
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
}
