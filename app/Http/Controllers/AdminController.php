<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Validator;
use Carbon\Carbon;

use App\User;
use App\UserDetail;
use App\UserAddress;
use App\UserCompanyDetail;
use App\UserProfileImg;
use App\UserHistory;

class AdminController extends Controller
{
    /*
    Next :
    ->profile page : edit and modify admin content
    ->delete function.
    ->search function(ajax)
    ->modify company list
    -->show owner img when hover.
    -->view model = show company img & animate.css(use).
    */
    public function dashboard()
    {
        $total = User::where('user_type','!=','0')->count();
        $num_company = User::where('user_type','=','2')->count();
        $num_user = User::where('user_type','=','1')->count();

        //get new registration in a week before
        $from = Carbon::now()->subWeeks(1);
        $till = Carbon::now();
        $new_reg = User::whereBetween('created_at',[$from,$till])
                    ->whereIn('user_type',[1,2])
                    ->orderby('created_at','desc')
                    ->get();

        return view('layouts.admin.dashboard')
        ->with(['total' => $total , 'num_company' => $num_company, 'num_user' => $num_user,'newReg' => $new_reg]);
    }

    public function profile()
    {
        $profile = Auth::user();
        return view('layouts.admin.profile',['profile' => $profile]);
    }

    public function users()
    {
        $lists = User::where('user_type',1)->paginate(10);
        $isUserList = true;

        return view('layouts.admin.user_list')
        ->with(['isUsers' => $isUserList, 'lists' => $lists]);
    }

    public function company()
    {
        $lists = User::where('user_type',2)->paginate(10);
        $isCompList = true;
        return view('layouts.admin.company_list')
        ->with(['isComp' => $isCompList, 'lists' => $lists]);
    }

    public function search($search)
    {
        
    }

    public function Delete($id)
    {
        echo 'Delete : '.$id;
    }

    public function edit($id)
    {
        $find = User::find($id);
        return view('layouts.admin.edit',['profile' => $find]);
    }

    public function save(Request $req,$id)
    {
        $edit = User::find($id);

        if($edit){
            $validate = Validator::make($req->all(),[
                'email' => 'required|email',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ]);

            if($validate->fails())
            {
                return redirect()
                ->back()
                ->withInput()
                ->withErrors($validate);
            }

            $email = $req['email'];
            $password = $req['password'];

            $edit->email = $email;
            $edit->password = bcrypt($password);
            $edit->save();;
        }else{

            return redirect()
            ->route('admin.profile',['msg' => 'Edit failed.User not found(Are you sure YOU an admin?).','done' => false ]);
        }

        return redirect()
        ->route('admin.profile',['msg' => 'Edit success.','done' => true ]);
    }
}
