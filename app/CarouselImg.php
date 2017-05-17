<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarouselImg extends Model
{
    public function Admin()
    {
        if(Auth::user() -> user_type === 0)
        {
            return $this->belongsTo('App\User');
        }

        return null;
    }
}
