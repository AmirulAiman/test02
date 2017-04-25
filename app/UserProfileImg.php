<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfileImg extends Model
{
    public function UserDetail()
    {
        return $this->belongsTo('App\UserDetail');
    }
}
