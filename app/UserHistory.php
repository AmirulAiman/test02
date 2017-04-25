<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    public function UserDetail()
    {
        return $this->belongsTo('App\UserDetail');
    }
}
