<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content'];
    public function user(){
        return $this->belongsTo('App\User'); 
    }
    public function categories(){
        return $this->hasMany('App\Category');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
