@extends('master')

@section('title','admin')

@section('admin.userslist','active')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-label">List of Registered Users</h3>
        </div>
        <div class="panel-body">
            @if(count($lists) > 0) 
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Tel Number</th>
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
                            <td>{{ $lists[$i]->email }}</td>
                            <td>{{ $lists[$i]->UserDetails->tel_no }}</td>
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
                                                     @if($lists[$i]->UserDetails->UserProfileImg->profile_img == null)
                                                        @if($lists[$i]->UserDetails->gender === 'male')
                                                            <img src="{{ asset('img/boy.png') }}" class="media-object" style="width:160px">
                                                        @else
                                                            <img src="{{ asset('img/girl.png') }}" class="media-object" style="width:160px">
                                                        @endif
                                                    @else
                                                        <img src="data:image/{{ $lists[$i]->UserDetails->UserProfileImg->file_type }};base64,{{($lists[$i]->UserDetails->UserProfileImg->profile_img)}}" class="media-object" style="width:160px">
                                                    @endif
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">{{ $lists[$i]->UserDetails->name }}</h4>
                                                    <p><lagend>Gender : {{ $lists[$i]->UserDetails->gender }}</lagend><br>
                                                    <lagend>Address : <br>
                                                        {{ $lists[$i]->UserDetails->UserAddress->address }},<br>
                                                        {{ $lists[$i]->UserDetails->UserAddress->postcode }},{{ $lists[$i]->UserDetails->UserAddress->city }},<br>
                                                        {{ $lists[$i]->UserDetails->UserAddress->state }}.
                                                    </lagend><br>
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
                <h3 class="" style="text-align:center;">No user registered in the system.</h3>
            @endif
        </div>
        <div class="panel-footer">
            <ul class="pagination pagination-default">
                {{ $lists->links() }}
            </ul>
        </div>
    </div>
    <script>
        $(".delete").on("submit", function(){
            return confirm("Do you want to delete this user?");
        });
    </script>
@endsection