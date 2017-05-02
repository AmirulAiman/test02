@extends('master')

@section('title','login')
@section('content')
    @if(count($errors) > 0)
        <ul>
            @foreach($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form class="form-horizontal" action="{{ route('main.login') }}" method="post">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name ="email" placeholder="Enter email">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Password:</label>
            <div class="col-sm-10"> 
                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password">
            </div>
        </div>
        <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </div>
        </div>
    </form>
@endsection