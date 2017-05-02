@extends('master')

@section('title','dashboard')

@section('user.dashboard','active')

@section('content')
<div class="">
    <h4>Dashboard</h4>
    <hr>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pane-title">User Requested Service Record</h4>
        </div>
        <div class="panel-body">
        <h4 class="" style="text-align: center">Currently you did not make any orders/Service request to any company. Go to company list and select there.</h4>
        </div>
        <div class="panel-footer">
        </div>
    </div>
</div>
@endsection