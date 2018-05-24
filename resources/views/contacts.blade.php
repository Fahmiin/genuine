@extends('layouts.app')

@section('CSS')

@endsection

@section('content')
<div class="container">
	<div class="row">
		<h4>Your contacts</h4>
		<div class="col s12 m5">
			@if(empty($user->bookmarks->count()))
			<h5>You have no contacts yet. Follow someone to get started</h5>
			@else
			<div class="collection">
				@foreach($contacts as $contact)
				<a href="/profile/{{$contact->user->id}}" class="collection-item">
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
		<div class="col m1 hide-on-med-and-down"></div>
		<div class="col s12 m6">
			
		</div>
	</div>
</div>
@endsection

@section('JS')

@endsection