<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
     protected $table = "subjects";

     public function documentations() {
     	return $this->hasMany('App\Documentation', 'subject_id', 'id');
     }
     
    public function user_created() {
    	return $this->belongsTo('App\User', 'user_id' ,'id');
    }
}
