@extends('master')

@section('title','Request List')
@section('company.request','active')

@section('content')
<style type="text/css">
    div.scroll{
        overflow: auto;
        white-space: nowrap;
    }

    div.scroll img{
        border: 1px solid black;
        display: inline-block;
        color: white;
        text-align: center;
        text-decoration:none;
    }
</style>
<div>
    <h5>List of Customer Request</h5>
    <hr>
    @if(count($orders) > 0)
        @foreach($orders as $order)
        <div class="panel-group" id="order{{$order->id }}">
            <div class="panel panel-{{ ($order->done === 0 ? 'info' : ($order->done === 3 ? 'danger' : 'success')) }}">
                <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#order{{$order->id }}" href="#grp{{$order->id }}">
                        From : {{ $order->UserDetails->name }}
                    </a>
                    @if($order->done === 0)
                        <a class="btn btn-danger btn-xs pull-right" href="{{ route('company.accept',['i'=>$order->id,'r' => 0]) }}">Decline?</a>
                        <a class="btn btn-warning btn-xs pull-right" style="margin-right: 10px" href="{{ route('company.accept',['i'=>$order->id,'r' => 1]) }}">Accept?</a>
                    @else
                        <a class="btn btn-success btn-xs pull-right" style="margin-right: 10px" href="{{ route('company.accept',['i'=>$order->id,'r' => 2]) }}">Finish?</a>
                    @endif
                    </h4>
                </div>
                <div id="grp{{$order->id }}" class="panel-collapse collapse out">
                    <div class="panel-body">
                        <div class="">
                        @if($order->done === 2 && $order->hasPayed != 1)
                            <a class="btn btn-success btn-sm pull-right" style="margin-right: 10px" href="{{ route('company.payed',['id' => $order->id]) }}">Already Payed?</a>
                        @endif
                            <h5>Description :<br>{{ $order->description }}</h5>
                            <h5>Due Date :<strong>{{ date('d-M-Y', strtotime($order->created_at)) }}</strong></h5>
                            <h5>Requester Contact number : {{ $order->UserDetails->tel_no }}</h5>
                            <h5>Delivery Address : <br>
                                <p>
                                {{ $order->UserDetails->UserAddress->address }}<br>
                                {{ $order->UserDetails->UserAddress->postcode }},{{$order->UserDetails->UserAddress->city}}<br>
                                {{ $order->UserDetails->UserAddress->state}}.
                                </p>
                            </h5>
                            <hr>
                            @if(count($order->UserOrderImgs) > 0)
                                <div class="scroll">
                                    @foreach($order->UserOrderImgs as $img)
                                        <img alt="order image" src="data:image/{{ $img->file_type }};base64,{{($img->order_img)}}" class="media-object" style="width:300px;">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
             </div>
         </div>
        @endforeach
        <div clas="">
            <ul class="pagination">
                {{ $orders->render() }}
            </ul>
        </div>
    @else
    <h5 class="text-center">No request available</h5>
    @endif
</div>
@endsection