<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title',	'body',	'photo', 'slug'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function tag(){
        return $this->belongsToMany('App\Models\Tag');
    }

     public function comments()
    {
        return $this->hasMany('App\Models\Comment' )->whereNull('parent_id');
    }
}
