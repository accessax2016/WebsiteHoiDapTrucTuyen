<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = "answers";

    public function user() {
    	return $this->belongsTo('App\User', 'user_id' ,'id');
    }

    public function question() {
        return $this->belongsTo('App\Question', 'question_id' ,'id');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function votes()
    {
        return $this->morphMany('App\Vote', 'votable');
    }
}
