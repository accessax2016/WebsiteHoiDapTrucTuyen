<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "tags";

    public function questions() {
    	return $this->morphedByMany('App\Question', 'taggable');
    }

    public function documentations() {
    	return $this->morphedByMany('App\Documentation', 'taggable');
    }

    public function users() {
        return $this->morphedByMany('App\User', 'taggable');
    }
         
    public function user_created() {
        return $this->belongsTo('App\User', 'user_id' ,'id');
    }

    
}
