@extends('master')

@section('title','Profile')

@section('company.profile','active')

@section('content')
<div class="">
    <h4>Profile Page</h4>
</div>
<hr>
<div>
    <div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Company Owner Information</a>
        </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h5>Name : {{ $user->UserDetails->name }}</h5>
                        <h5>Tel No : {{ $user->UserDetails->tel_no }}</h5>
                        <h5>Gender : {{ $user->UserDetails->gender }}</h5>
                        <h5>Account Email : {{ $user->email }}</h5>
                    </div>
                    <div class="col-lg-6">
                        <h5>Profile Image</h5>
                        <img src="data:image/{{ $user->UserDetails->UserProfileImg->file_type }};base64,{{($user->UserDetails->UserProfileImg->profile_img)}}" class="media-object" style="width:200px; border: 1px solid black;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                Company Information</a>
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="row">
                    <div>
                        <h5>Company Name : {{ $user->UserDetails->UserCompanyDetail->company_name}}</h5>
                        <h5>Company Contact Detail : <br> Tel No : <b>{{ $user->UserDetails->UserCompanyDetail->company_tel_no }}</b><br> Company Email : <b>{{ $user->UserDetails->UserCompanyDetail->company_email }}</b></h5>
                        <h5>Company Location/Address : <br>{{$user->UserDetails->UserAddress->address}},<br>{{ $user->UserDetails->UserAddress->postcode}},{{ $user->UserDetails->UserAddress->city}},<br>{{ $user->UserDetails->UserAddress->state }}.</h5>
                    </div>
                    <div>
                       <img src="data:image/{{ $user->UserDetails->UserCompanyDetail->file_type }};base64,{{($user->UserDetails->UserCompanyDetail->comp_img)}}" class="media-object" style="width:200px; border: 1px solid black;"> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection