<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    public function UserDetails()
    {
        return $this->belongsTo('App\UserDetail','user_detail_id','id');
    }

    public function UserCompanyDetails()
    {
        return $this->belongsTo('App\UserCompanyDetail','company_detail_id','id');
    }

    public function UserOrderImgs()
    {
        return $this->hasMany('App\UserOrderImg');
    }
}
