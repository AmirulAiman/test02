@extends('master')

@section('title','Comany Lists')

@section('user.List','active')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading">
        <h5 class="panel-title">List of available Company</h5>
    </div>
    <div class="panel-body">
        @if(count($lists) > 0)
        <table class="table table-hover table-bordered table-condensed">
            <thead>
            <tr>
                <th>Image</th>
                <th>Detail</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0; $i < count($lists) ; $i++)
            <tr>
                <td style="width: 10px;">
                @if($lists[$i]->UserDetails->UserCompanyDetail->comp_img != null)
                    <img alt="embedded image" src="data:image/{{ $lists[$i]->UserDetails->UserCompanyDetail->file_type }};base64,{{($lists[$i]->UserDetails->UserCompanyDetail->comp_img)}}" class="media-object" style="width:160px">
                @else
                    <img src="{{ asset('img/store.png') }}" style="width:160px" />
                @endif
                </td>
                <td>
                    <label>{{ $lists[$i]->UserDetails->UserCompanyDetail->company_name }} </label><br>
                    Address : <br>
                    <p>
                    {{ $lists[$i]->UserDetails->UserAddress->address }}, <br>
                    {{ $lists[$i]->UserDetails->UserAddress->postcode }},{{ $lists[$i]->UserDetails->UserAddress->city }},<br>
                    {{ $lists[$i]->UserDetails->UserAddress->state }}.
                    </p>
                    <label>Service Offered : </label><br>
                    @foreach($lists[$i]->UserDetails->UserCompanyDetail->CompanyServices->all() as $service)
                        {{ $service->services }} : RM{{ $service->price_offered}}
                    @endforeach
                </td>
                <td><a class="btn btn-primary" href="{{ route('user.order',['requested_company' => $lists[$i]->UserDetails->UserCompanyDetail->id]) }}">Request service</a></td>
            </tr>
            @endfor
            </tbody>
        </table>
        @else
        <h5>Sorry no company registered</h5>
        @endif
    </div>
    <div class="panel-footer">
        <ul class="pagination pagination-default">
            {{ $lists->links() }}
        </ul>
    </div>
</div>
@endsection
