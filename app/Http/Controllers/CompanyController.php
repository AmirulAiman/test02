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
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }

        return view('layouts.company.dashboard');
    }

    public function profile()
    {
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }
        //show user history in profile page
        echo 'history page';
    }

    public function request()
    {
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }
        return view('layouts.company.request');
    }

    public function record()
    {
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }
        //show request status, payed or not
        echo 'record page';
    }
}
