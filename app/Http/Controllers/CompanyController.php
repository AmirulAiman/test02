<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\User;
use App\UserDetail;
use App\UserAddress;
use App\UserCompanyDetail;
use App\CompanyService;
use App\UserHistory;
use App\UserOrder;

class CompanyController extends Controller
{
    public function dashboard()
    {
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with('msg','Your session has timed out and need to logged in again.');
        }

        $company = User::find(Auth::id());
        $order = $company->UserDetails->UserCompanyDetail->UserOrders->where('done','!=',2);
        return view('layouts.company.dashboard',['orders' => $order]);
    }

    public function profile()
    {
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }

        $user = User::find(Auth::id());
        return view('layouts.company.profile')->with('user',$user);
    }

    public function request()
    {
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }

        $company = User::find(Auth::id());
        $order = $company->UserDetails->UserCompanyDetail->UserOrders()->paginate(10);
             
        return view('layouts.company.request',['orders' => $order]);
    }

    public function accept($id,$r)
    {
        if(!Auth::check())
        {
            if(!Auth::user()->user_type === 2)
            {
                return redirect()
                ->route('main.home')
                ->with('msg','Your did not have te permission to be accessing the URL specified.');
            }
            return redirect()
            ->route('main.home')
            ->with('msg','Your session has timed out and needed to log in again.');
        }

        $user = User::find(Auth::id());

        $record = new UserHistory();

        $get_order = UserOrder::find($id);

        if($r === '1')
        {
            //Accept
            $get_order->done = 1;
            $get_order->save();
            $record->action = "Accept service request from".$get_order->UserDetails->name.".";
            $record->record_time = Carbon::now();
        }else if($r === '2')
        {
            //Done
            $get_order->done = 2;
            $get_order->save();
            $record->action = "Mark service request from".$get_order->UserDetails->name." as Done.";
            $record->record_time = Carbon::now();
        }else{
            //decline order
            $get_order->done = 3;
            $get_order->save();
            $record->action = "Decline service request from".$get_order->UserDetails->name.".";
            $record->record_time = Carbon::now();
        }
        $user->UserDetails->UserHistory()->save($record);
        return redirect()->back();
    }

    public function hasPayed($id)
    {
        $order = UserOrder::find($id);

        if($order->hasPayed === 0)
        {
            $order->hasPayed = 1;
            $order->save();
        }
        return redirect()->back();
    }
}
