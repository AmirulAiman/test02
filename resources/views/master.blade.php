<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>OverHere | @yield('title') </title>
        <!-- Fonts -->
        <link href="{{  asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{  asset('css/animate.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        @include('includes.navbar')
        <div class="container">
            @yield('content')
        </div>
    </body>
    <script src="{{asset('js/jquery-1.11.3.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
</html>
