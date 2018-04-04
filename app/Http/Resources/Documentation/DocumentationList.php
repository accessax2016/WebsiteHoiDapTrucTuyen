<?php

namespace App\Http\Resources\Documentation;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Tag\TagList;
use App\Http\Resources\Activity\ActityInteract;

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
            'summary' => $this->summary,
            'viewed' => $this->view,
            'voted' => $this->countVote($this->votes),
            'tags' => TagList::collection($this->tags),
            'user_last_interact' => new ActityInteract($this->activities->last()), 
        ];
    }

    public function countVote($votes) {
        $countvotes_up = $votes->where('vote_action', 'up')->count();
        $countvotes_down = $votes->where('vote_action', 'down')->count();
        return $countvotes_up - $countvotes_down;
    }
}
