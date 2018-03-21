<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "permissions";

    public function users() {
    	return $this->hasMany('App\User', 'permission_id' ,'id');
    }

    public function user_created() {
    	return $this->belongsTo('App\User', 'user_id' ,'id');
    }
}
