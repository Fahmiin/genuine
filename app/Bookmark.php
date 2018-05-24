<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
	protected $fillable = [
        'userP_id',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User', 'userP_id');
    }
}
