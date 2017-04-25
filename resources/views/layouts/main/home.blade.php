@extends('master')

@section('title','Home')

@section('home','active')

@section('content')
@if(Session::has('msg'))
    {{Session::get('msg')}}
@endif
@endsection