<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressState extends Model
{
    public function UserAddress()
    {
        return $this->hasMany('App\UserAddress','address_state_id','id');
    }
}
