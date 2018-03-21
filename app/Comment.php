<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";

    public function user() {
    	return $this->belongsTo('App\User', 'user_id' ,'id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function pings() {
        return $this->hasMany('App\Ping', 'comment_id', 'id');
    }
}
