<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
/*
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
*/

class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use Authenticatable;

    public function UserDetails()
    {
        return $this->hasOne('App\UserDetail');
    }

    public function Carousel()
    {
        if(Auth::user()->user_type === 0)
        {
            return $this->hasMany('App\CarouselImg');
        }
        return null;
    }
}
