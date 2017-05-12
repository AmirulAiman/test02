<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;
use Input;
use Carbon\Carbon;
use DB;

use App\User;
use App\UserDetail;
use App\UserAddress;
use App\UserProfileImg;
use App\UserCompanyDetail;
use App\UserCompanyOrder;
use App\UserOrder;
use App\UserOrderImg;
use App\UserHistory;


class UserController extends Controller
{
    public function dashboard()
    {
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }

        $user = User::find(Auth::id());
        
        $detail = UserDetail::where('user_id',Auth::id())->get();
        //$order = $detail->UserOrders();
        return view('layouts.users.dashboard')->with(['orders' => $detail]);
    }

    public function delete_request($id)
    {
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }

        $user = User::find(Auth::id());

        $order = UserOrder::find($id);
        while($order->UserOrderImgs)
        {
            $order->UserOrderImgs->delete();
        }
        $order->delete();

        $history = new UserHistory();
        $history->action = 'Delete order to '.$order->UserCompanyDetails->company_name.'.';
        $history->record_time = Carbon::now();
        $user->UserDetails->UserHistory()->save($history);

        return redirect()->back();
    }

    public function lists()
    {
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }
        $lists = User::where('user_type',2)->paginate(5);
        return view('layouts.users.list',['lists' => $lists]);
    }

    public function history()
    {
        $user = User::find(Auth::id());
        
        return view('layouts.users.history')->with(['history' => $user]);   
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
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }
        $find = User::find($id);

        return view('layouts.users._edit',['edit' => $find]);
    }

    public function save(Request $req)
    {
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }
        //custom validation error msg.
        $validate = Validator::make($req->all(),[
            'name' => 'required',
            'gender' => 'required',
            'tel_no' => 'required',
            'profileImg' => 'present|mimes:jpeg,jpg,png',
            'address' => 'required',
            'postcode' => 'alpha_num|required',
            'city' => 'required',
            'state' => 'required',
            'email' => 'required|email|unique:users,email',
            'pwd' => 'required|confirmed',
            'pwd_confirmation' => 'required' 
        ]);

        if($validate->fails())
        {
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validate);
        }

        $id = Auth::id();
        $name = $erq['name'];
        $gender = $req['gender'];
        $tel_no = $req['tel_no'];
        $address = $req['address'];
        $postcode = $req['postcode'];
        $city = $req['city'];
        $state = $req['state'];
        $email = $req['email'];
        $pwd = $req['pwd'];

        $find = User::find($id);
        
        if($req->hasFile('profileImg')){
            $file = file_get_contents($req->file('profileImg'));
            $filePath = $req->file('profileImg')->getRealPath();
             $fileType = pathinfo($filePath,PATHINFO_EXTENSION);
            $convert = base64_encode($file);
        }else{
            $convert = $find->UserDetails()->UserProfileImg()->profile_img;
            $fileType = $find->UserDetails()->UserProfileImg()->file_type;
        }


    }

    public function make($id)
    {
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }
        
        $get_info = UserCompanyDetail::find($id);
        return view('layouts.users.make_order',['requested' => $get_info]);
    }

    public function record(Request $req)
    {
        if(!Auth::check()){
            return redirect()
            ->route('main.home');
        }

        $user = User::where('id',Auth::id())->first();
        $comp = UserCompanyDetail::where('id',$req['comp_id'])->first();
        $rules =[
            'serviceRequested' => 'required',
            'description' => 'required',
            'dueDate' => 'required',
            'descriptionImg.*' => 'present'
        ];

        $validate = Validator::make($req->all(), $rules);

        if($validate->fails())
        {
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput();
        }
        
        $description = $req['description'];
        $serviceRequested = $req['serviceRequested'];
        $dueDate = $req['dueDate'];

        $order = new UserOrder();
        $order->description = $description;
        $order->service_requested = $serviceRequested;
        $order->due_date = $dueDate;
        $order->company_detail_id = 0;
        $user->UserDetails->UserOrders()->save($order);
        $comp->UserOrders()->save($order);
        
        foreach($req['descriptionImg'] as $img)
        {
            $temp = file_get_contents($img);
            $filePath = $img->getRealPath();
            $file_type = pathInfo($filePath,PATHINFO_EXTENSION);
            $pic = base64_encode($temp);

            $orderImg = new UserOrderImg();
            $orderImg->order_img = $pic;
            $orderImg->file_type = $file_type;
            $order->UserOrderImgs()->save($orderImg);
        }
        $record = new UserHistory();
        $record->action = "Create new Order to ".$comp->company_name.".";
        $record->record_time = Carbon::now();
        $user->UserDetails->UserHistory()->save($record);

        return redirect()
        ->route('user.dashboard');
    }
}
