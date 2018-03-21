<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Cache;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function isOnline()
    // {
    //     return Cache::has('user-is-online-' . $this->id);
    // }

    public function permission() {
        return $this->belongsTo('App\Permission', 'permission_id', 'id');
    }

    public function questions() {
        return $this->hasMany('App\Question', 'user_id', 'id');
    }

    public function answers() {
        return $this->hasMany('App\Answer', 'user_id', 'id');
    }

    public function documentations() {
        return $this->hasMany('App\Documentation', 'user_id', 'id');
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'user_id', 'id');
    }

    public function tags() {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    public function votes() {
        return $this->hasMany('App\Vote', 'user_id', 'id');
    }

    public function activities() {
        return $this->hasMany('App\Activity', 'user_related_id', 'id');
    }

    public function permission_created() {
        return $this->hasMany('App\Permission', 'user_id', 'id');
    }

    public function subject_created() {
        return $this->hasMany('App\Subject', 'user_id', 'id');
    }

    public function tag_created() {
        return $this->hasMany('App\Tag', 'user_id', 'id');
    }
}
