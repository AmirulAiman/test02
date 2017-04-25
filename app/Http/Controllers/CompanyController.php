<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Users;
use App\UserDetail;
use App\UserAddress;
use App\CompanyService;
use App\CompanyOrder;
use App\UserCompanyOrder;
use App\UserHistory;

class CompanyController extends Controller
{
    public function dashboard()
    {
        return view('layouts.company.dashboard');
    }

    public function profile()
    {
        //show user history in profile page
        echo 'history page';
    }

    public function request()
    {
        return view('layouts.company.quest');
    }

    public function record()
    {
        //show request status, payed or not
        echo 'record page';
    }
}
