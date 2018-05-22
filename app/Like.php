<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function post()
    {
    	return $this->belongsTo('App\post');
    }

    public function user()
    {
    	return $this->beelongsTo('App\User');
    }
}