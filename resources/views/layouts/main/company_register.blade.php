@extends('master')

@section('title','Register')
@section('register','active')

@section('content')
<form class="form-horizontal" action="{{ route('main.save.company') }}" method="post" enctype="multipart/form-data">
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
    <legend style="text-align:center;"><u>Register as T-shirt Serrvice Provider</u></legend>
    <div class="form-group">
      <label for="name" class="col-lg-2 control-label">Owner</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="name" name="name" placeholder="Owner fullname" value="">
      </div>
    </div>
    <div class="form-group">
      <label for="gender" class="col-lg-2 control-label">Gender</label>
      <div class="col-lg-10">
        <label class="radio-inline"><input type="radio" name="gender" value="male">Male</label>
        <label class="radio-inline"><input type="radio" name="gender" value="female">Female</label>
      </div>
    </div>
    <div class="form-group">
      <label for="owner_tel_no" class="col-lg-2 control-label">Owner Contact No</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="tel_no" name="owner_tel_no" placeholder="Contact number" value="">
      </div>
    </div>
    <div class="form-group">
      <label for="owner_img" class="col-lg-2 control-label">Owner Picture</label>
      <div class="col-lg-10">
        <input type="file" class="form-control" id="owner_img" name="owner_pic" placeholder="Owner picture(Optional)">
      </div>
    </div>
    <legend style="text-align:center;"><u>Company detail</u></legend>
    <div class="form-group">
      <label for="comp_name" class="col-lg-2 control-label">Company Name</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="comp_name" name="comp_name" placeholder="Company name" value="">
      </div>
    </div>
    <div class="form-group">
      <label for="comp_pic" class="col-lg-2 control-label">Company/Shop Picture</label>
      <div class="col-lg-10">
        <input type="file" class="form-control" id="comp_pic" name="comp_pic" placeholder="Company/Shop Picture">
      </div>
    </div>
    <div class="form-group">
      <label for="comp_email" class="col-lg-2 control-label">Company Email</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="comp_email" name="comp_email" placeholder="Company's email(Optional)">
      </div>
    </div>
    <div class="form-group">
      <label for="comp_tel_no" class="col-lg-2 control-label">Company Contact No</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="comp_tel_no" name="comp_tel_no" placeholder="Company Contact number" value="">
      </div>
    </div>
    <div class="form-group">
      <label for="comp_service" class="col-lg-2 control-label">Service Provided</label>
      <div class="col-lg-10">
        <div class="panel panel-default">
          <div class="panel-body">
            <label class="checkbox-inline">
                <input type="checkbox" value="T-shirt Printing" id="comp_service" name="comp_service[]">T-shirt Printing
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" value="T-shirt Supplier" id="comp_service" name="comp_service[]">T-shirt Supplier
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group">
        <label for="address" class="col-lg-2 control-label">Address</label>
        <div class="col-lg-10">
            <textarea class="form-control" rows="3" id="address" name="address" placeholder="Address detail"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="postcode" class="col-lg-2 control-label">Postcode</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Address's postcode" value="">
        </div>
    </div>
    <div class="form-group">
        <label for="city" class="col-lg-2 control-label">City</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="city" name="city" placeholder="City name" value="">
        </div>
    </div>
    <div class="form-group">
        <label for="state" class="col-lg-2 control-label">State</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="state" name="state" placeholder="State" value="">
        </div>
    </div>
    <legend style="text-align:center;"><u>Account Info</u></legend>
    <div class="form-group">
        <label for="email" class="col-lg-2 control-label">Email</label>
        <div class="col-lg-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="email" value="">
        </div>
    </div>
    <div class="form-group">
        <label for="pwd" class="col-lg-2 control-label">Password</label>
        <div class="col-lg-10">
            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="password" value="">
        </div>
    </div>
    <div class="form-group">
        <label for="reenter" class="col-lg-2 control-label">Reenter Password</label>
        <div class="col-lg-10">
            <input type="password" class="form-control" id="reenter" name="pwd_confirmation" placeholder="Enter password again" value="">
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