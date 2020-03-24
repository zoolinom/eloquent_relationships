<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function user()
    {
        // profile belongs to one user (inverse of one to one relation)
        return $this->belongsTo(User::class);
    }
}
