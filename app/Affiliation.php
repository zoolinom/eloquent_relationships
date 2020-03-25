<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Affiliation extends Model
{
    public function posts()
    {
        /**
         * Has many what? Posts
         * Through what? Users table
         * 
         * We want to grab posts but for affiliation there is no post_id
         * so we can grab this through users table (column affiliation_id)
         */
        return $this->hasManyThrough(Post::class, User::class);
    }
}
