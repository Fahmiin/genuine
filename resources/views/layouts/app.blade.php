<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="{{asset('./materialize 1.0.0/css/materialize.min.css')}}"  media="screen,projection"/>
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

        @yield('mainCSS')

        @yield('profileCSS')

        <title>Genuine</title>
    </head>
    <body>
        
        @include('nav')

        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="container">
                    <div class="card-panel red lighten-1 white-text">
                        {{$error}}
                    </div>
                </div>
            @endforeach
        @endif

        @yield('content')
        
        @include('fixed_button')

        <footer>

        </footer>
    </body>
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('./materialize 1.0.0/js/materialize.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{asset('js/main.js')}}"></script>

    @yield('profileJS')
    
</html>