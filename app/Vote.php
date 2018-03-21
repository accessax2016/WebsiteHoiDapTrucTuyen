<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = "votes";

    public function user() {
    	return $this->belongsTo('App\User', 'user_id' ,'id');
    }

    public function votable()
    {
        return $this->morphTo();
    }
}
