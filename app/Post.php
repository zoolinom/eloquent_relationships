<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body',
    ];

    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * $post = App\Post::first();
     * $post->tags;
     * And we get error:
     * Illuminate/Database/QueryException with message 'SQLSTATE[42S02]:
     * Base table or view not found: 1146 Table 'eloquent_relationships.tags' doesn't exist
     * (SQL:
     * select `tags`.*,
     * `post_tag`.`post_id` as `pivot_post_id`,
     * `post_tag`.`tag_id` as `pivot_tag_id`
     * from `tags`
     * inner join `post_tag` on `tags`.`id` = `post_tag`.`tag_id`
     * where `post_tag`.`post_id` = 1
     * )'
     * 
     * It looks like we need 3 tables:
     * 1. posts
     * 2. tags
     * 3. post_tag - this is called pivot table, named in alphabetic order
     * 
     * 
     * $post = App\Post::find(1);
     * $post->tags()->attach(2);
     * We programatically added to table post_tag, post_id = id of post (in this case 1) and tag_id = 2
     * 
     * $post->tags()->detach(2);
     * Removing from pivot table
     * 
     * $post->tags()->attach([1, 2]);
     * 
     * $tag = App\Tag::first();
     * $post->tags()->attach($tag);
     */
    public function tags()
    {
        /**
         * Lets say that post can have any number of tags
         * personal, family, vacation, ...
         * But does for example tag personal have or belongs to only one post?
         * Answer is: No
         */
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
