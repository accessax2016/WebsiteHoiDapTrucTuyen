<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = "questions";

    public function user() {
    	return $this->belongsTo('App\User', 'user_id' ,'id');
    }

    public function tags() {
    	return $this->morphToMany('App\Tag', 'taggable');
    }

    public function answers() {
        return $this->hasMany('App\Answer', 'question_id', 'id');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function votes()
    {
        return $this->morphMany('App\Vote', 'votable');
    }

    // public function countvotes() {
    //     return $this->morphMany('App\Vote', 'votable')->count();
    // }

    // public function haveBestAnswer() {
    //     $best_answer = $this->answers->where('best_answer', true);
    //     if (count($best_answer) > 0) {
    //         return true;
    //     }
    //     return false;
    // }
     
    public function activities() {
        return $this->morphMany('App\Activity', 'activitable');
    }
}
