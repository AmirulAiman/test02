<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;
use Input;
use Carbon\Carbon;

use App\User;
use App\UseDetail;
use App\UserAddress;
use App\UserProfileImg;
use App\UserCompanyOrder;
use App\UserOrder;
use App\UserOrderImg;
use App\UserHistory;


class UserController extends Controller
{
    public function dashboard()
    {
        return view('layouts.users.dashboard');
    }

    public function profile()
    {
        if(Auth::check()){
            $user = Auth::user();
            return view('layouts.users.profile',['profile' => $user]);
        }
    }

    public function edit($id)
    {
        $find = User::find($id);

        return view('layouts.users._edit',['edit' => $find]);
    }

    public function save(Request $req)
    {
        echo 'save page';
    }
}
