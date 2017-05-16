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
            <li class="@yield('admin.dashboard')"><a href="{{route('admin.dashboard') }}">Dashboard</a></li>
            <li class="@yield('admin.userslist')"><a href="{{ route('admin.list.users') }}">User List</a></li>
            <li class="@yield('admin.companylist')"><a href="{{ route('admin.list.company')}}">Company List</a></li>

        @elseif(Auth::check() && Auth::user()->user_type === 1)
            <li class="@yield('user.dashboard')"><a href="{{route('user.dashboard') }}">Dashboard</a></li>
            <li class="@yield('user.List')"><a href=" {{ route('user.list')}}">List T-shirt Company</a></li>
            <li class="@yield('user.history')"><a href="{{ route('user.history')}}">Previous Activity</a></li>
            <!--<li><a href="#">List T-shirt Company</a></li>-->

        @elseif(Auth::check() && Auth::user()->user_type === 2)
            <li class="@yield('company.dashboard')"><a href="{{route('company.dashboard') }}">Dashboard</a></li>
            <li class="@yield('company.request')"><a href="{{ route('company.request.list') }}">Customer Request</a></li>

        @else
            <li class="@yield('main.company-list')"><a href={{ route('main.lists')}}>Browse Our List of T-shirt Service Company</a></li>
        @endif
      </ul>
      <ul class="nav navbar-nav navbar-right">
      @if(Auth::check())
        @if(Auth::user()->user_type === 1)
            <li class="@yield('user.profile')"><a href="{{ route('user.profile') }}"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
        @elseif(Auth::user()->user_type === 2)
            <li class="@yield('company.profile')"><a href="{{ route('company.profile') }}"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
        @else
            <li class="@yield('admin.profile')"><a href="{{ route('admin.profile') }}"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
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
        <li><a href="{{ route('main.signin') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    @endif
      </ul>
    </div>
  </div>
</nav>