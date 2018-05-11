@extends('layouts.app')

@section('searchCSS')
	<link rel="stylesheet" type="text/css" href="{{asset('css/search.css')}}">
@endsection

@section('content')
	<div class="container">
		@if(count($searchedUsers) > 0)
		<div class="collection">
			@foreach($searchedUsers as $searchedUser)
				<a href="profile/{{$searchedUser->id}}" class="collection-item">
					<div class="row">
						<div class="col s1 m1 center-align">
							<img src="/uploads/profilepic/{{$searchedUser->profilepic}}" class="circle">
						</div>
						<div class="col s11 m11 profileBar">
							<span class="profileLink">{{$searchedUser->name}}</span>
							<span class="profileTagline right hide-on-med-and-down"><em>" ... {{$searchedUser->tagline}} ... "</em></span>
						</div>
					</div>
				</a>
			@endforeach
		</div>
		@else
			<h4 class="center-align">Oops! No users found</h4>
		@endif
	</div>
@endsection

@section('searchJS')
	<script src="{{asset('js/search.js')}}"></script>
@endsection