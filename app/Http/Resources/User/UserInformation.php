<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Question\QuestionRelated;
use App\Http\Resources\Documentation\DocumentationRelated;
use Illuminate\Support\Collection;
use App\Http\Resources\Answer\AnswerRelated;

class UserInformation extends JsonResource
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
            'status' => $this->status,
            'about' => $this->about,
            'location' => $this->location,
            'job' => $this->job,
            'date' => $this->created_at,
            'top_question' => QuestionRelated::collection($this->getTopQuestion($this->questions)),
            'top_documentation' => DocumentationRelated::collection($this->getTopDocumentation($this->documentations)),
            'top_answer' => AnswerRelated::collection($this->getTopAnswer($this->answers))
        ];
    }

    public function getTopQuestion($questions)
    {
       return $questions->sortByDesc(function($question) {
            $countvotes_up = $question->votes->where('vote_action', 'up')->count();
            $countvotes_down = $question->votes->where('vote_action', 'down')->count();
            return $countvotes_up - $countvotes_down;
        })->take(5);
    } 

    public function getTopDocumentation($documentations)
    {
       return $documentations->sortByDesc(function($documentation) {
            $countvotes_up = $documentation->votes->where('vote_action', 'up')->count();
            $countvotes_down = $documentation->votes->where('vote_action', 'down')->count();
            return $countvotes_up - $countvotes_down;
        })->take(5);
    } 

    public function getTopAnswer($answers)
    {
        $top_answer = $answers->sortByDesc(function($answer) {
            $countvotes_up = $answer->votes->where('vote_action', 'up')->count();
            $countvotes_down = $answer->votes->where('vote_action', 'down')->count();
            return $countvotes_up - $countvotes_down;
        })->values()->take(5);

        $questions = new Collection;
        foreach ($top_answer as $answer) {
            $question = $answer->question;
            $question['voted'] = $this->countVote($answer->votes);
            $questions->push($question);
        }

        return $questions;
    }

    public function countVote($votes) {
        $countvotes_up = $votes->where('vote_action', 'up')->count();
        $countvotes_down = $votes->where('vote_action', 'down')->count();
        return $countvotes_up - $countvotes_down;
    }
}
