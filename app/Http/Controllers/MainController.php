<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\UserDetail;
use App\UserAddress;
use App\AddressState;
use App\UserProfileImg;
use App\UserCompanyDetail;
use App\CompanyService;

use Carbon\Carbon;
use Validator;
use Hash;

class MainController extends Controller
{
    public function Home()
    {
        return view('layouts.main.home');
    }

    public function CompanyList()
    {
        return view('main.list');
    }
    public function Login(Request $req)
    {
        $msg = null;

        $validate = Validator::make($req->all(),[
            'email' => 'required',
            'pwd' => 'required'
        ]);

        if($validate->fails()){
            return redirect()
            ->back()
            ->withErrors($validate);
        }

        $email = $req['email'];
        $password = $req['pwd'];

        if(!Auth::attempt(['email' => $email , 'password' => $password ])){

            $msg = 'Failed to login';
            return redirect()
            ->back()
            ->with(['msg' => $msg]);

        }else{

          $curr_user = User::where('email',$email)->first();

          if($curr_user){

                if($curr_user->user_type === 1){
                    return redirect()->route('user.dashboard');
                }else if($curr_user->user_type === 2){
                    return redirect()->route('company.dashboard');
                }else{
                    return redirect()->route('admin.dashboard');
                }

          }else{

              $msg = 'This email does not registered in the database.';

              return redirect()
              ->back()
              ->with(['msg' => $msg]);
          }

        }
    }

    public function Logout()
    {
        if(Auth::check())
        {
            Auth::logout();
            return redirect()
            ->route('main.home');
            
        }else{
            return redirect()
            ->back();
        }
    }

    public function UserRegister()
    {
        return view('layouts.main.user_register');
    }

    public function UserSignUp(Request $req)
    {
        //Note : Error message need custom.
        $errorMsg = [];

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

        if($validate -> fails()){
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validate);    
        }else{
            // assign input.
            $name = $req['name'];
            $gender = $req['gender'];
            $telno = $req['tel_no'];
            $address = $req['address'];
            $postcode = $req['postcode'];
            $city = $req['city'];
            $state = $req['state'];
            $email = $req['email'];
            $pwd = $req['pwd'];
            $user_type = 1;
            $last_login = Carbon::now();

            //file handling
            if($req->hasFile('profileImg')){
                $file = file_get_contents($req->file('profileImg'));
                $filePath = $req->file('profileImg')->getRealPath();
                $fileType = pathinfo($filePath,PATHINFO_EXTENSION);
                $convert = base64_encode($file);
            }else{
                $fileType = null;
                $convert = null;
            }
        }
        
        $users = new User();
        $detail = new UserDetail();
        $user_address = new UserAddress();
        //$address_state = AddressState::where('state',$state)->first();
        $userProfileImg = new UserProfileImg();

        $users->email = $email;
        $users->password = bcrypt($pwd);
        $users->user_type = $user_type;
        $users->last_login = $last_login;
        $users->save();

        $detail->name = $name;
        $detail->gender = $gender;
        $detail->tel_no = $telno;
        $users->account_state = 0;
        $users->UserDetails()->save($detail);

        $user_address->address= $address;
        $user_address->city = $city;
        $user_address->postcode = $postcode;
        $user_address->state = $state;
        $detail->UserAddress()->save($user_address);

        $userProfileImg->profile_img = $convert;
        $userProfileImg->file_type = $fileType;
        $detail->UserProfileImg()->save($userProfileImg);

        /*
        if($address_state)
        {
            $address_state->UserAddress()->associate($detail);
            $address_state->save();
        }else
        {
            $address_state = new AddressState();
            $address_state->state = $state;
            $address_state->save();
            $address_state->UserAddress()->associate($detail);
            $address_state->save();
            //$user_address->UserAddresStates()->save($address_state);
        }*/
        
        $msg = "Register Success. Please sign to active your account.";

        return redirect()
        ->route('main.home')
        ->with(['msg'=>$msg]);
            
    }

    public function CompanyRegister()
    {
        return view('layouts.main.company_register');
    }

    public function CompanySignUp(Request $req)
    {
        //Note : Create custom errors message.
        $errorMsg = [];

        $validate = Validator::make($req->all(),[

            'name' => 'required',
            'gender' => 'required',
            'owner_tel_no' => 'required',
            'owner_pic' => 'present|image',
            'comp_name' => 'required',
            'comp_pic' => 'present|image',
            //'comp_email' => 'email',
            'comp_tel_no' => 'required',
            'comp_service.*' => 'required',
            'address' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'state' => 'required',
            'email' => 'required|unique:users,email|email',
            'pwd' => 'required|confirmed',
            'pwd_confirmation' => 'required'
        ]);

        if($validate->fails()){
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validate);
        }

        $name = $req['name'];
        $gender = $req['gender'];
        $tel_no = $req['owner_tel_no'];
        $comp_name = $req['comp_name'];
        $comp_email = $req['comp_email'];
        $comp_tel_no = $req['comp_tel_no'];
        $comp_service = $req['comp_service'];
        $address = $req['address'];
        $postcode = $req['postcode'];
        $city = $req['city'];
        $state = $req['state'];
        $email = $req['email'];
        $pwd = $req['pwd'];

        //Manage owner img file.
        if($req->hasFile('owner_pic')){
            $temp = file_get_contents($req->file('owner_pic'));
            $filePath = $req->file('owner_pic')->getRealPath();
            $owner_file_type = pathInfo($filePath,PATHINFO_EXTENSION);
            $owner_image = base64_encode($temp);
        }else{
            $owner_img = null;
            $owner_file_type = null;
        }

        //Manage company img file.
        if($req->hasFile('comp_pic')){
            $temp = file_get_contents($req->file('comp_pic'));
            $filePath = $req->file('comp_pic')->getRealPath();
            $comp_file_type = pathInfo($filePath,PATHINFO_EXTENSION);
            $comp_pic = base64_encode($temp);
        }else{
            $comp_pic = null;
            $comp_file_type = null;
        }

        $users = new User();
        $detail = new UserDetail();
        $user_address = new UserAddress();
        $company = new UserCompanyDetail();
        $service = new CompanyService();
        $profileImg = new UserProfileImg();

        $users->email = $email;
        $users->password = bcrypt($pwd);
        $users->user_type = 2;
        $users->last_login = Carbon::now();
        $users->save();

        $detail->name = $name;
        $detail->gender = $gender;
        $detail->tel_no = $tel_no;
        $users->UserDetails()->save($detail);

        $user_address->address = $address;
        $user_address->city = $city;
        $user_address->postcode = $postcode;
        $user_address->state = $state;
        $detail->UserAddress()->save($user_address);

        $profileImg->profile_img = $owner_image;
        $profileImg->file_type = $owner_file_type;
        $detail->UserProfileImg()->save($profileImg);

        $company->company_name = $comp_name;
        $company->company_email = $comp_email;
        $company->company_tel_no = $comp_tel_no;
        $company->comp_img = $comp_pic;
        $company->file_type = $comp_file_type;
        $detail->UserCompanyDetail()->save($company);

        for($i = 0; $i < count($comp_service) ; $i++){
            $service->services = $comp_service[$i];
            $company->CompanyServices()->save($service);
        }

        //managing file


        $msg = 'Register complete.Plese log in to active you account';

        return redirect()
        ->route('main.home')
        ->with(['msg' => $msg]);
    }
}
