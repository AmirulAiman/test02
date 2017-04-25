<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrderImg extends Model
{
    public function UserOrder()
    {
        return $this->belongsTo('App\UserOrder');
    }
}
