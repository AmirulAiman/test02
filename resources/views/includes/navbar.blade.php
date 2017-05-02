<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="@yield('home')"><a href="{{ route('main.home') }}">Home</a></li>
        @if(Auth::check() && Auth::user()->user_type === 0)
            <!--<li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">View List
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="#">Users</a></li>
                <li><a href="#">Companies</a></li>
                </ul>
            </li>-->
            <li class="@yield('admin.dashboard')"><a href="{{route('admin.dashboard') }}">Dashboard</a></li>
            <li class="@yield('admin.userslist')"><a href="{{ route('admin.list.users') }}">User List</a></li>
            <li class="@yield('admin.companylist')"><a href="{{ route('admin.list.company')}}">Company List</a></li>

        @elseif(Auth::check() && Auth::user()->user_type === 1)
            <li class="@yield('user.dashboard')"><a href="{{route('user.dashboard') }}">Dashboard</a></li>
            <li class="@yield('user.List')"><a href=" {{ route('user.list')}}">List T-shirt Company</a></li>
            <li><a href="#">Previous Activity</a></li>
            <!--<li><a href="#">List T-shirt Company</a></li>-->

        @elseif(Auth::check() && Auth::user()->user_type === 2)

            <li><a href="#">Customer Request</a></li>

        @else
            <li><a href=#>Browse Our List of T-shirt Service Company</a></li>
        @endif
      </ul>
      <ul class="nav navbar-nav navbar-right">
      @if(Auth::check())
        @if(Auth::user()->user_type === 1)
            <li><a href="{{ route('user.profile') }}"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
        @elseif(Auth::user()->user_type === 2)
            <li><a href="{{ route('company.profile') }}"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
        @else
            <li><a href="{{ route('admin.profile') }}"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
        @endif
        <li><a href="{{ route('main.logout') }}"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
      @else
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="glyphicon glyphicon-user"></span> Register
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
            <li><a href="{{ route('main.signup.user') }}">User</a></li>
            <li><a href="{{ route('main.signup.company') }}">T-shirt Company</a></li>
            </ul>
        </li>
        <li><a type="button" data-toggle="modal" data-target="#loginForm"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    @endif
      </ul>
    </div>
  </div>
</nav>
    <div id="loginForm" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Log In</h4>
                </div>
                <div class="modal-body">
                    @if(count($errors) > 0)
                        <ul>
                            @foreach($errors as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form class="form-horizontal" action="{{ route('main.login') }}" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email:</label>
                            <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name ="email" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Password:</label>
                            <div class="col-sm-10"> 
                            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password">
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Submit</button>
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            </div>
                        </div>
                        </form>
                </div>
                <div class="modal-footer">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
