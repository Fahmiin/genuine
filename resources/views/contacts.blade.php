@extends('layouts.app')

@section('CSS')
		<link rel="stylesheet" type="text/css" href="{{asset('css/contacts.css')}}">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<h4>Your contacts</h4>
		<div class="col s12 m4">
			@if(empty($user->bookmarks->count()))
			<p class="center">You have no contacts yet. Follow someone to add them to your contacts page</p>
			@else
			<div class="collection">
				@foreach($contacts as $contact)
				<a href="/quickview" class="collection-item quickView hide-on-med-and-down" data-id="{{$contact->user->id}}" id="{{$contact->user->id}}">
					<div class="row">
						<div class="col s3 m3">
							<img src="/uploads/profilepic/{{$contact->user->profilepic}}" class="profileImageComment">
						</div>
						<div class="col s9 m9">
							<p>{{$contact->user->name}}</p>
						</div>
					</div>
				</a>
				<a href="/profile/{{$contact->user->id}}" class="collection-item hide-on-large-only">
					<div class="row">
						<div class="col s3 m3">
							<img src="/uploads/profilepic/{{$contact->user->profilepic}}" class="profileImageComment">
						</div>
						<div class="col s9 m9">
							<p>{{$contact->user->name}}</p>
						</div>
					</div>
				</a>
				@endforeach
			</div>
			<div class="center-align">
				{{$contacts->links()}}
			</div>
			@endif
		</div>
		<div class="col m8 hide-on-med-and-down">
			<div id="quickView">
				<h6 class="center pulseBox orange white-text pulse">Select a profile for quick view</h6>
			</div>
		</div>
	</div>
</div>
@endsection

@section('JS')
	<script src="{{asset('js/contacts.js')}}"></script>
@endsection