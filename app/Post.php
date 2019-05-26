<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id', 'post_name','post_body',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\User', 'user_id');
    }

    public function images()
    {
    	return $this->hasMany('App\Post', 'post_id');
    }
}
