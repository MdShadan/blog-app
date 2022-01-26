<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['title', 'description', 'user_id', 'slug' ];

    public function author(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

     public function tags(){
        return $this->belongsToMany('App\Models\Tag', 'post_tags', 'post_id', 'tag_id');
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->whereNull('parent_id');
    }

}
