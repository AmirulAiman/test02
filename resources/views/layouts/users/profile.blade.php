@extends('master')

@section('title','Profile')

@section('user.profile','active')

@section('content')
<div class="">
    <h4>Profile</h4>
    <hr>
    <div class="panel panel-info">
        <div class="panel-body">
            <div class="media">
                <div class="media-left">
                @if($profile->UserDetails->UserProfileImg->profile_img === null)
                    @if($profile->UserDetails->gender === 'male')
                        <img class="media-object" style="width:160px" src="{{ asset('img/boy.jpg') }}">
                    @else
                        <img class="media-object" style="width:160px" src="{{ asset('img/girl.jpg') }}">
                    @endif
                @else
                    <img class="media-object" style="width:160px" src="data:image/{{ $profile->UserDetails->UserProfileImg->file_type }};base64,{{ ($profile->UserDetails->UserProfileImg->profile_img) }}">
                @endif
            </div>
            <div class="media-body">
                <div class="col-md-offset-10">
                    <!--<a href="{{ route('user.edit',['id' => $profile->id]) }}" type="button" class="btn btn-warning">Edit</a>-->
                </div>
                <h4 class="media-heading">{{ $profile->UserDetails->name }}</h4>
                <div class="">
                    <h4>Phone Number : {{ $profile->UserDetails->tel_no }}</h4>
                    <h4>Email : {{ $profile->email }}</h4>
                    <h4>Address : </h4>
                    <p>
                        {{ $profile->UserDetails->UserAddress->address}},{{ $profile->UserDetails->UserAddress->postcode }}<br>
                        {{ $profile->UserDetails->UserAddress->city }},<br>
                        {{ $profile->UserDetails->UserAddress->state }}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection