<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCompanyDetail extends Model
{
    public function UserDetails()
    {
            return $this->belongsTo('App\UserDetail');
    }

    public function UserOrders()
    {
        return $this->hasMany('App\UserOrder','company_detail_id','id');
    }

    public function CompanyServices()
    {
        return $this->hasMany('App\CompanyService','user_company_detail_id');
    }

}
