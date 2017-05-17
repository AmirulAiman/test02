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
    public function dashboard()
    {
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }

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
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }

        $profile = Auth::user();
        return view('layouts.admin.profile',['profile' => $profile]);
    }

    public function users()
    {
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }

        $lists = User::where('user_type',1)->paginate(10);
        $isUserList = true;

        return view('layouts.admin.user_list')
        ->with(['isUsers' => $isUserList, 'lists' => $lists]);
    }

    public function company()
    {
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }

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
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }

        $user = User::find($id);
        if($user)
        {
            if($user->UserDetails)
            {
                if($user->UserDetails->UserCompanyDetail)
                {
                    $user->UserDetails->UserCompanyDetail->delete();
                }
                $user->UserDetails->delete();
            }
            $user->delete();
        }
        return redirect()->back()->with(['msg' => 'Account Terminated']);
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
        return view('layouts.admin.edit',['profile' => $find]);
    }

    public function save(Request $req,$id)
    {
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }

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

    public function caraousel()
    {
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }

        $imgs = CarouselImg::all();
        
        return view('layouts.admin.edit_caraousel')->with('imgs',$imgs);
    }

    public function caraousel_save(Request $req)
    { 
        if(!Auth::check())
        {
            return redirect()
            ->route('main.home')
            ->with(['msg','You need to login to continue.']);
        }

        $validate = Validator::make($req, [
            'img.*' => 'present'
        ]);

        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate);
        }

        $user = User::find(Auth::id());
        if($user->user_type != 0)
            echo '<script>console.log("Error!")</script>';

        foreach($req as $input)
        {
            $img = new CarouselImg();
            if($input->hasFile('image')){
                
                $file = $input['image'];
                $fileName = $file->getClientOriginalName();
                $destination = public_path().'/img/car';
                $file->move($destination,$fileName);
                
                $img->file_name = $fileName;
                $img->directory = $destination;
                
                $user->Carousel()->save($img);
            }
        }

        return redirect()->back()->with('msg','Save Success');
    }
}
