<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TO-Sytem | @yield('title') </title>
        <!-- Fonts -->
        <link href="{{  asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{  asset('css/animate.css') }}" rel="stylesheet" type="text/css">
        <style>
            .navbar{
                margin-bottom:0px;
            }
            .sidediv{
                padding-top:20px;
                height:100%;
                background-color:#f1f1f1;
            }
            footer {
                background-color: #555;
                color: white;
                padding: 15px;
    }
        </style>
    </head>
    <body>
        @include('includes.navbar')
        <div class="container-fluid">
            <div class="row" style="height: 540px;">
                <div class="sidediv col-sm-1 text-center"></div>
                <div class="col-sm-10" style="margin-top:10px;">
                    @yield('content')
                </div>
                <div class="sidediv col-sm-1 text-center"></div>
            </div>
        </div>
    </body>
    <footer class="container-fluid text-center">
        <p>Welcome</p>
    </footer>
    <script src="{{asset('js/jquery-1.11.3.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
</html>
