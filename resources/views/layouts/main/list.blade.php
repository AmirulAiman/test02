@extends('master')

@section('title','Company Available')

@section('list','active')

@section('content')
    @if(count($lists) > 0)
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">List of Available Company Registered</h4>
        </div>
        @foreach($lists as $list)
        <div class="panel-body">
            <div class="media">
                <div class="media-left">
                    <img alt="embedded image" src="data:image/{{ $list->file_type }};base64,{{($list->comp_img)}}" class="media-object" style="width:160px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{ $list->company_name }}</h4>
                    <p>
                        <h5> Location/Address : content not print</h5>
                        <h5> Company Email : {{ $list->company_email }}</h5>
                        <h5> Company Tel No : {{ $list->company_tel_no}}</h5>
                    </p>
                </div>
             </div>
        </div>
        <hr>
        @endforeach
        <div class="panel-footer">
            <ul class="pagination">
                {{ $lists->render() }}
            </ul>
        </div>
    </div>
    @else
        <h5 class="text-center">No company has registered in the system</h5>
    @endif
@endsection