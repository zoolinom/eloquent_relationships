<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
        /**
         * This is not true
         * Tag does not belongs to one Post
         * Tag is associated with post
         * There we have many to many relationship
         * Post can have many tags and tag is associated with many posts
         */
        return $this->belongsToMany(Post::class)->withTimestamps();
        // return $this->belongsTo(Post::class);
    }
}
