@extends('master')

@section('title','Profile')

@section('admin.profile','active')

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('msg'))
  <div class="alert alert-danger">
    <h4 class="">{{ Session::get('msg') }}</h4>
  </div>
@endif
<div class="panel panel-info">
  <div class="panel-body">
    <form class="form-horizontal" action=" {{ route('admin.save',['id' => Auth::user()->id]) }}" method="post">
        <div class="form-group">
          <label for="email" class="col-lg-2 control-label">New Email</label>
          <div class="col-lg-10">
            <input type="emal" class="form-control" id="oemail" name="email" placeholder="Insert new email" value="{{ $profile->email }}">
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-lg-2 control-label">new password</label>
          <div class="col-lg-10">
            <input type="password" class="form-control" id="password" name="password" placeholder="Insert new password">
          </div>
        </div>
        <div class="form-group">
          <label for="password_confirmation" class="col-lg-2 control-label">Renter password</label>
          <div class="col-lg-10">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="renter new password">
          </div>
        </div>
        <div class="col-lg-offset-6">
          <input type="submit" value="Save" class="btn btn-submit">
          <input type="hidden" name="_token" value="{{ Session::token() }}" >
        </div>
    </form>
  </div>
</div>
@endsection