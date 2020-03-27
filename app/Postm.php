<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postm extends Model
{
    use Likable;
}

/**
 * DB
 * 
 * posts
 *  - id
 *  - title
 *  - body
 * 
 * users
 *  - id
 * 
 * post_user
 *  - user_id
 *  - post id
 */
