<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_id'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
