@extends('master')

@section('title','Edit')

@section('user.edit','active')

@section('content')
<div class="">
    <form class="form-horizontal" action="{{ route('user.edit') }}" method="post">
    Edit page
    </form>
</div>
@endsection