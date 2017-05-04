@extends('master')

@inject('date', 'Carbon\Carbon')

@section('title','Dashboard')

@section('company.dashboard','active')

@section('content')
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
            <table class="table table-horizontal table-striped">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>From</td>
                        <td>Request</td>
                        <td>Request at</td>
                        <td>Due date</td>
                        <td>Detail</td>
                        <td>Accept</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>User 01</td>
                        <td>50 plain t-shirt as shown</td>
                        <td>Kelantan</td>
                        <td>30/05/2017</td>
                        <td>
                            <button type="button" class="btn btn-info">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection