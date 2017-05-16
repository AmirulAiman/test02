@extends('master')

@section('title','Home')

@section('home','active')

@section('content')
@if(Session::has('msg'))
    <div class="text-center">{{ Session::get('msg') }}</div>
@endif

<div class="">
    @include('includes.carousel')
</div>
<hr>
<div class="row container-fluid">
    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Want to register your t-shirt service company online?
            </div>
            <div class="panel-body">
                Try register with us, and find the local customer that seek the service you offered.
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5 class="panel-title">Looking for t-shirt printing service in the area?</h5>
            </div>
            <div class="panel-body">
                <p>Why not try browsing our collection of t-shirt company list, maybe you could find the nearest in your area.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">Want to order t-shirt printing or t-shirt service online?</div>
            <div class="panel-body">
                <p>then stop looking and register now OverHere</p>
            </div>
        </div>
    </div>
</div>
@if(!Auth::check())
<div class="panel panel-primary">
    <div class="panel-footer">
        <h4 class="text-center">Interested, Sign up now, as <a href="{{route('main.signup.company') }}">T-Shirt Printing Provider</a> or <a href="{{ route('main.signup.user') }}">User</a></h4>
    </div>
</div>
@endif
@endsection