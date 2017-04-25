<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    public function UserDetails()
    {
        return $this->belongsTo('App\UserDetail');
    }

    public function UserAddresStates()
    {
        return $this->belongsTo('App\AddressState','address_state_id');
    }

    public function UserCompanyDetail()
    {
        return $this->hasOne('App\UserCompanyDetail');
    }
}
