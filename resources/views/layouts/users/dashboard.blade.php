@extends('master')

@section('title','dashboard')

@section('user.dashboard','active')

@section('content')
<div class="">
    <h4>Dashboard</h4>
    <hr>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pane-title">User Requested Service Record</h4>
        </div>
        <div class="panel-body">
        @if(count($orders) > 0)
            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Order Descriptions</th>
                    <th>To</th>
                    <th>Service Requested</th>
                    <th>Date Created</th>
                    <th>Status</th>
                    <th>Details</th>
                    <th>Delete?</th>
                    </tr>
                </thead>
                <tbody>
            @foreach($orders as $order)
                @for($i = 0; $i < count($order->UserOrders); $i++)
                <tr style="border: solid 1px black" class="{{($order->UserOrders[$i]->done === 0 ? 'danger' : ( $order->UserOrders[$i]->done === 1 ? 'warning' : 'success')) }}">
                    <td>{[ $i ]}</td>
                    <td>{{ $order->UserOrders[$i]->description }}</td>
                    <td>{{ $order->UserOrders[$i]->UserCompanyDetails->company_name }}</td>
                    <td>{{ $order->UserOrders[$i]->service_requested }}</td>
                    <td>{{ date('d-M-Y', strtotime($order->UserOrders[$i]->created_at)) }}</td>
                    <td>{{($order->UserOrders[$i]->done === 0 ? 'Requested' : ( $order->UserOrders[$i]->done === 1 ? 'Accepted' : 'Done')) }}</td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#{{$order->UserOrders[$i]->id}}">Detail</button>
                    </td>
                    <td><a href="#" onclick="confirmed()" class="btn btn-default btn-solid {{($order->UserOrders[$i]->done === 1 ? 'disable' : '')}}">Delete</a></td>
                </tr>
                <div id="{{$order->UserOrders[$i]->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Detail</h4>
                        </div>
                        <div class="modal-body">
                            <h5>To : {{ $order->UserOrders[$i]->UserCompanyDetails->company_name }}</h5>
                            <h5>description : <br>{{$order->UserOrders[$i]->description}}</h5>
                            <h5>Due Date : {{date('d-M-Y', strtotime($order->UserOrders[$i]->due_date))}}</h5>
                            <h5>Image Send : </h5>
                            <div class="row" style="height:160px;">
                                <div class="col-lg-3">
                                @if(count($order->UserOrders[$i]->UserOrderImgs) > 0)
                                    @foreach($order->UserOrders[$i]->UserOrderImgs as $img)
                                        <img class="media-object" style="width:250px;" src="data:image/{{ $img->file_type }};base64,{{ ($img->order_img) }}">
                                    @endforeach
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                        </div>

                    </div>
                    </div>
                <script>
                    function confirmed()
                    {
                        if(window.confirm("Are you sure?"))
                        {
                            window.location = "{{ route('user.order.delete',['id' => $order->UserOrders[$i]->id]) }}";
                        }
                    }
                </script>
                @endfor
            @endforeach
                </tbody>
            </table>
        @else
        <h5 class="" style="text-align: center">
            Currently you did not make any orders/Service request to any company. Go to company list and select there.
        </h5>
        @endif
        </div>
        <div class="panel-footer">
        </div>
    </div>
</div>
@endsection