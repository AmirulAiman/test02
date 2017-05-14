@extends('master')

@section('title','Dashboard')

@section('company.dashboard','active')

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
    <div class="">
    <hr>
        <h4>Company Dashboard</h4>
    <hr>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <label class="panel-title">New T-shirt service request</label>
        </div>
        <div class="panel-body">
        @if(count($orders) > 0)
            <table class="table table-horizontal table-striped">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>From</td>
                        <td>Request</td>
                        <td>Requester Origin</td>
                        <td>Request at</td>
                        <td>Due date</td>
                        <td>Detail</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>1</td>
                        <td>{{ $order->UserDetails->name }}</td>
                        <td>{{ $order->service_requested }}</td>
                        <td>{{ $order->UserDetails->UserAddress->state }}</td>
                        <td>{{ date('d-M-Y', strtotime($order->created_at))  }}</td>
                        <td>{{ date('d-M-Y', strtotime($order->due_date)) }}</td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#user{{$order->id}}" class="btn btn-info">Detail</button>
                        </td>
                        <div id="{{ 'user'.$order->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Order Detail</h4>
                                </div>
                                <div class="modal-body">
                                    <h5>Description : <br>{{$order->description}}</h5>
                                    @if(count($order->UserOrderImgs) > 0)
                                    <div class="scroll">
                                    @for($i = 0; $i < count($order->UserOrderImgs) ; $i++)
                                       <img alt="embedded image" src="data:image/{{ $order->UserOrderImgs[$i]->file_type }};base64,{{($order->UserOrderImgs[$i]->order_img)}}" class="media-object" style="width:160px">
                                    @endfor
                                    </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                            </div>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <h5 class="text-center">No Service Currently Requested.</h5>
            @endif
        </div>
    </div>
</div>
@endsection