@extends('master')

@section('title','admin')

@section('admin.companylist','active')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-label">List of Registered Company</h3>
        </div>
        <div class="panel-body">
            @if(count($lists) > 0) 
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Owner</th>
                            <th>Company name</th>
                            <th>Location(State)</th>
                            <th>Account Status</th>
                            <th>Detail</th>
                            <th>Delete?</th>
                        </tr>
                    </thead>
                    <tbody>
                @for($i = 0 ; $i < count($lists) ; $i++)
                        <tr>
                            <td>1</td>
                            <td>{{ $lists[$i]->UserDetails->name }}</td>
                            <td>{{ $lists[$i]->UserDetails->UserCompanyDetail->company_name }}</td>
                            <td>{{ $lists[$i]->UserDetails->UserAddress->state }}</td>
                            <td>{{ ($lists[$i]->UserDetails->account_state === 0 ? 'Inactive' : 'Active') }}</td>
                            <td>
                                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#{{ $lists[$i]->id }}">
                                    View
                                </button>
                                <div id="{{ $lists[$i]->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-header">User's detail</h4>
                                            </div>
                                            <div class="modal-body">
                                               <div class="media">
                                                <div class="media-left">
                                                @if($lists[$i]->UserDetails->UserCompanyDetail->comp_image === null)
                                                    <img src="{{ asset('img/store.png') }}" class="media-object" style="width:160px">
                                                @else
                                                    <img alt="store image" src="data:image/{{ $lists[$i]->UserDetails->UserCompanyDetail->file_type }};base64,{{($lists[$i]->UserDetails->UserCompanyDetail->comp_img)}}" class="media-object" style="width:160px">
                                                @endif
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">Name : {{ $lists[$i]->UserDetails->UserCompanyDetail->company_name }}</h4>
                                                    <hr>
                                                    <h4>Email : {{ ($lists[$i]->UserDetails->UserCompanyDetail->company_email == null) ? 'not available' : $lists[$i]->UserDetails->UserCompanyDetail->company_email }}</h4>
                                                    <h4>Store Location : <br>
                                                        {{ $lists[$i]->UserDetails->UserAddress->address }},<br>
                                                        {{ $lists[$i]->UserDetails->UserAddress->postcode }},{{ $lists[$i]->UserDetails->UserAddress->city }},<br>
                                                        {{ $lists[$i]->UserDetails->UserAddress->state }}.
                                                    </h4><br>
                                                    </p>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form class="delete" action="{{ route('admin.delete',$lists[$i]->id) }}" method="get">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input class="btn btn-warning" type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                @endfor
                    </tbody>
                </table>
            @else
                <h3 class="" style="text-align:center;">No company registered in the system.</h3>
            @endif
        </div>
        <div class="panel-footer">
            <ul class="pagination pagination-default">
                {{ $lists->links() }}
            </ul>
        </div>
    </div>
    <script>
        $(document).ready(function(){

        });
    </script>
@endsection