@extends('master')

@section('title','Order')

@section('user.List','active')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading">
        <h5 class="panel-title">Make Order</h5>
    </div>
    <div class="panel-body">
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
        <h5>{{ Session::get('msg') }}</h5>
    @endif
        <h4>You requesst order with : <b>{{$requested->company_name }}</b></h4>
        <form class="form-horizontal" method="post" action="{{ route('user.order.record')}}" enctype="multipart/form-data">
            <fieldset>
                <legend>Complete the detail:</legend>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Service Required</label>
                    <div class="col-lg-10">
                    @foreach($requested->CompanyServices->all() as $service)
                    <div class="radio">
                        <label>
                            <input type="radio" name="serviceRequested" id="optionsRadios1" value="{{ $service->id }}">
                            {{ $service->services }}
                        </label>
                        </div>
                    @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label for="textArea" class="col-lg-2 control-label">Description</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="3" id="textArea" name="description"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="img" class="col-lg-2 control-label">Design Image/Example</label>
                    <div class="col-lg-10">
                        <input type="file" id="img" name="descriptionImg[]" multiple>
                        <p class="text-info">Select multiple file if you have more than a file to upload</p>
                    </div>
                </div>
                <hr>
                <div class="col-lg-offset-5">
                    <input type="submit" class="btn btn-primary" value="submit">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </div>
            </fieldset>
        </form>
    </div>
    <div class="panel-footer">
        
    </div>
</div>
@endsection
