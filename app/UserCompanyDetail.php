<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCompanyDetail extends Model
{
    public function UserDetails()
    {
            return $this->belongsTo('App\UserDetail');
    }

    public function CompanyServices()
    {
        return $this->hasMany('App\CompanyService','user_company_detail_id');
    }

    public function UserCompanyOrders()
    {
        return $this->hasMany('App\UserCompanyOrder');
    }

}
