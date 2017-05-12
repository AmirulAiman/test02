@extends('master')

@section('title','History')

@section('user.history','active')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-tilte">User History of Usage</h4>
    </div>
    <div class="panel-body">
    @if(count($history) > 0)
        <table class="table table-striped table-hover ">
            <thead>
                <tr>
                <th>Date</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($history->UserDetails->UserHistory->all() as $activity)
                <tr>
                    <td>{{ date('d-M-Y', strtotime($activity->record_time ))}}</td>
                    <td>{{ $activity->action }}</td>
                    </tr>
                @endforeach
           </tbody>
        </table>
    @else
        <h5 class="text-center">No Recorded activity yet.</h5>
    @endif
    </div>
    <div class="panel-footer"></div>
</div>
@endsection