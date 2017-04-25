@extends('master')

@section('title','Profile')

@section('admin.profile','active')

@section('content')
<div>
    <div class="">
        <hr>
            <h4>Admin profile page</h4>
        <hr>
    </div>
    <div class="panel panel-primary">
    <div class="panel-heading">
        <h5 class="panel-title">Detail</h5>
    </div>
    <div class="panel-body">
        <h5><b>Email :</b> {{$profile->email }}</h5>
        <h5><b>Last Login :</b> {{ $profile->last_login }}</h5>
    </div>
    <div class="panel-footer">
        <div class="col-md-offset-11">
            <a class="btn btn-warning" href="#">Edit</a>
        </div>
    </div>
    </div>
</div>
@endsection