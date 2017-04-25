@extends('master')

@section('title','register')
@section('register','active')

@section('content')
<form class="form-horizontal" action="{{ route('main.save.user') }}" method="post"  enctype="multipart/form-data">
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <fieldset>
    <legend style="text-align:center;"><u>Register as Users</u></legend>
    <div class="form-group">
      <label for="name" class="col-lg-2 control-label">Name</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="name" name="name" placeholder="Fullname" value="Amirul Aiman">
      </div>
    </div>
    <div class="form-group">
      <label for="gender" class="col-lg-2 control-label">Gender</label>
      <div class="col-lg-10">
        <label class="radio-inline"><input type="radio" name="gender" value="male" checked="checked" >Male</label>
        <label class="radio-inline"><input type="radio" name="gender" value="female">Female</label>
      </div>
    </div>
    <div class="form-group">
      <label for="tel_no" class="col-lg-2 control-label">Contact No</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="tel_no" name="tel_no" placeholder="Contact number" value="0145047396">
      </div>
    </div>
    <div class="form-group">
      <label for="profile_img" class="col-lg-2 control-label">Profile Picture</label>
      <div class="col-lg-10">
        <input type="file" class="form-control" id="profile_img" name="profileImg" placeholder="Profile Picture(Optional)">
      </div>
    </div>
    <legend style="text-align:center;"><u>Mailing Info</u></legend>
    <div class="form-group">
        <label for="address" class="col-lg-2 control-label">Address</label>
        <div class="col-lg-10">
            <textarea class="form-control" rows="3" id="address" name="address" placeholder="Address detail">Lot 942, Belakang Balai Polis Meranti</textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="postcode" class="col-lg-2 control-label">Postcode</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Address's postcode" value="17010">
        </div>
    </div>
    <div class="form-group">
        <label for="city" class="col-lg-2 control-label">City</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="city" name="city" placeholder="City name" value="Pasir Mas">
        </div>
    </div>
    <div class="form-group">
        <label for="state" class="col-lg-2 control-label">State</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="state" name="state" placeholder="State" value="Kelantan">
        </div>
    </div>
    <legend style="text-align:center;"><u>Account Info</u></legend>
    <div class="form-group">
        <label for="email" class="col-lg-2 control-label">Email</label>
        <div class="col-lg-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="email" value="aiman_amirul@ymail.com">
        </div>
    </div>
    <div class="form-group">
        <label for="pwd" class="col-lg-2 control-label">Password</label>
        <div class="col-lg-10">
            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password" value="12345">
        </div>
    </div>
    <div class="form-group">
        <label for="reenter" class="col-lg-2 control-label">Reenter Password</label>
        <div class="col-lg-10">
            <input type="password" class="form-control" id="reenter" name="pwd_confirmation" placeholder="Enter password again" value="12345">
        </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="submit" class="btn btn-primary">Submit</button>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
      </div>
    </div>
  </fieldset>
</form>
@endsection