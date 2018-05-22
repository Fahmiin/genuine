<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="{{asset('./materialize 1.0.0/css/materialize.min.css')}}"  media="screen,projection"/>
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('./select2/select2.min.css')}}">

        @yield('CSS')

        <title>Genuine</title>
    </head>
    <body>
        
        @include('nav')

        @include('error_flash')

        @yield('content')
        
        @include('fixed_button')

        <footer>

        </footer>
        
    </body>
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('./materialize 1.0.0/js/materialize.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('./select2/select2.min.js')}}"></script>

    @yield('JS')

    @include('success_toast')

</html>