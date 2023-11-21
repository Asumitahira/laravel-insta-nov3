<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    # Use this method to get the categories under each specific post
    # one to many method relationship
    public function categoryPost()
    {
        return $this->hasMany(categoryPost::class);
    }

    # <ADD> Use this method to get information about posts in the selected category
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post', 'category_id', 'post_id')->latest();
    }
}
