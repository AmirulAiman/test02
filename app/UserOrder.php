<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    public function UserDetails()
    {
        return $this->belongsTo('App\UserDetail');
    }

    public function UserOrderImgs()
    {
        return $this->hasMany('App\UserOrderImg');
    }
}
