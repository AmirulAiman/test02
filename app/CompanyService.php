<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyService extends Model
{
    public function UserCompanyDetails()
    {
        return $this->belongsTo('App\UserCompanyDetail','user_company_detail_id');
    }

    public function UserOrders()
    {
        return $this->belongsTo('App\UserOrder');
    }
}
