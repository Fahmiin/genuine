@extends('layouts.app')

@section('searchCSS')
	<link rel="stylesheet" type="text/css" href="{{asset('css/search.css')}}">
@endsection

@section('content')
	<div class="container">
		@if(count($searchedUsers) > 0)
		<ul class="collection">
			@foreach($searchedUsers as $searchedUser)
				<li class="collection-item avatar">
					<img src="/uploads/profilepic/{{$searchedUser->profilepic}}" class="circle">
					<span class="title"><a href="profile/{{$searchedUser->id}}" class="profileLink">{{$searchedUser->name}}</a></span>
				</li>
			@endforeach
			</ul>
		@else
			<h4 class="center-align">Oops! No users found</h4>
		@endif
	</div>
@endsection

@section('searchJS')
	<script src="{{asset('js/search.js')}}"></script>
@endsection