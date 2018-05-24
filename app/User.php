<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function detail()
    {
        return $this->hasOne('App\Detail');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review', 'userP_id');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function bookmarks()
    {
        return $this->hasMany('App\Bookmark');
    }
}
