@extends('master')

@inject('date', 'Carbon\Carbon')

@section('title','Dashboard')

@section('admin.dashboard','active')

@section('content')
<div>
    <div class="">
    <hr>
        <h4>Admin Dashboard</h4>
    <hr>
    </div>
    <div class="col-ls-6">
        <ul class="nav nav-pills">
            <li class="">
                <a href="#">Total Registered <span class="badge">{{ $total }}</span></a>
            </li>
            <li>
                <a href="#">Company<span class="badge">{{ $num_company }}</span></a>
            </li>
            <li>
                <a href="#">Users<span class="badge">{{ $num_user }}</span></a>
            </li>
        </ul>
    </div>
    <hr>
    <div class="">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <label class="panel-title">New Registration</label>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Users'/Owners' Name</th>
                        <th>Email</th>
                        <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                    @for($i = 0; $i < count($newReg) ; $i++)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $newReg[$i]->UserDetails->name }}</td>
                            <td>{{ $newReg[$i]->email }}</td>
                            <td>{{ $date->now()->toDateTimeString() }}</td>
                        </tr>
                    @endfor
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>
@endsection