@extends('master')

@section('title','Home')

@section('home','active')

@section('content')
@if(Session::has('msg'))
    <div class="text-center">{{ Session::get('msg') }}</div>
@endif
@endsection