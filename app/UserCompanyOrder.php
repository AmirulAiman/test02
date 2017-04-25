<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCompanyOrder extends Model
{
    public function UserCompanyDetails()
    {
        return $this->belongsTo('App\UserCompanyDetail');
    }

    public function UserDetails()
    {
        return $this->belongsTo('App\UserDetail');
    }

    public function UserOrders()
    {
        return $this->belongsTo('App\UserOrder');
    }
}
