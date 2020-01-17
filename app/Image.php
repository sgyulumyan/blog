<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = [
    	'user_id', 'post_id', 'image',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

     public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }
}
