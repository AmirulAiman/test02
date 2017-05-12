<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    public function Users()
    {
        return $this->belongsTo('App\User');
    }

    public function UserProfileImg()
    {
        return $this->hasOne('App\UserProfileImg');
    }
    
    public function UserAddress()
    {
        return $this->hasOne('App\UserAddress');
    }

    //If the registered user register for company
    public function UserCompanyDetail()
    {
        return $this->hasOne('App\UserCompanyDetail');
    }

    public function UserOrders()
    {
        return $this->hasMany('App\UserOrder','user_detail_id','id');
    }

    public function UserHistory()
    {
        return $this->hasMany('App\UserHistory');
    }
    
}
