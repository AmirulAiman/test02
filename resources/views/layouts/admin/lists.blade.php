@extends('master')

@inject('date', 'Carbon\Carbon')

@section('title','Dashboard')

@if(Session::has('isUsers'))
    @section('admin.user.list','active')
@else
    @section('admin.dashboard','active')
@endif

@section('content')

@endsection