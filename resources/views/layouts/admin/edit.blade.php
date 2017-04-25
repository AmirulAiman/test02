@extends('master')

@section('title','Profile')

@section('admin.profile','active')

@section('content')
<form class="form-horizontal" action=" {{ route('admin.save',['id' => Auth::user()->id]) }}" method="post">
    <div class="form-group">
      <label for="email" class="col-lg-2 control-label">New Email</label>
      <div class="col-lg-10">
        <input type="emal" class="form-control" id="oemail" name="email" placeholder="Insert new email)">
      </div>
    </div>
    <div class="form-group">
      <label for="password" class="col-lg-2 control-label">new password</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="password" name="password" placeholder="Insert new password">
      </div>
    </div>
    <div class="form-group">
      <label for="password_confirmation" class="col-lg-2 control-label">New Email</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="renter new password">
      </div>
    </div>
</form>
@endsection