<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected $table = "documentations";

     public function user() {
    	return $this->belongsTo('App\User', 'user_id' ,'id');
    }

     public function tags() {
    	return $this->morphToMany('App\Tag', 'taggable');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function votes()
    {
        return $this->morphMany('App\Vote', 'votable');
    }
    public function subject()
    {
        return $this->belongsTo('App\Subject', 'subject_id','id');
    }
}
