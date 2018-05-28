<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="{{asset('materialize 1.0.0/css/materialize.min.css')}}"  media="screen,projection"/>
        <link rel="stylesheet" type="text/css" href="{{asset('css/landing_page.css')}}">

		<title>Lingo</title>
	</head>
	<body>
		<div class="colored">
			<img src="{{asset('public/Lingo.png')}}">
		</div>
	</body>
	<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('materialize 1.0.0/js/materialize.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</html>