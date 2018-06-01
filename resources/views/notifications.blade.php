@extends('layouts.app')

@section('CSS')
	<link rel="stylesheet" type="text/css" href="{{asset('css/notif.css')}}">
@endsection

@section('content')
<div class="container">
	<h5>Notifications panel</h5>
	<a href="/mark">Mark all as read</a>
	<div class="collection">
		@foreach($user->unreadNotifications as $notification)
		<div class="row">
			<div class="col s10 m11">
				<a 
					@if($notification->type == 'App\Notifications\PostLike')
					href="/profile"
					@else
					href="/profile/{{$notification->data['user_id']}}" 
					@endif
					class="collection-item row">
					<span class="col s9 m9 notifArea">
						{{$notification->data['user']}}
						<span class="postTimestamp">{{$notification->created_at->diffForHumans()}}</span>
					</span>
					<span class="col s2 m2 center-align">
						@if($notification->type != 'App\Notifications\NewFollower')
						<img src="/uploads/postPic/{{$notification->data['post']}}" class="notifPic">
						@endif
					</span>
				</a>
			</div>
			<div class="col s2 m1 center-align">
				<a href="/mark/{{$notification->id}}"><i class="material-icons markMarginTop">close</i></a>
			</div>
		</div>
		@endforeach
	</div>
	<div class="collection">
		@foreach($user->readNotifications as $notification)
			<a 
				@if($notification->type == 'App\Notifications\PostLike')
				href="/profile"
				@else	
				href="/profile/{{$notification->data['user_id']}}"
				@endif
				class="collection-item orange darken-1 white-text row">
				<span class="col s10 m10 notifArea">
					{{$notification->data['user']}}
					<span class="postTimestamp">{{$notification->created_at->diffForHumans()}}</span>
				</span>
				<span class="col s2 m2 center-align">
					@if($notification->type != 'App\Notifications\NewFollower')
					<img src="/uploads/postPic/{{$notification->data['post']}}" class="notifPic">
					@endif
				</span>
			</a>
		@endforeach
	</div>
</div>
@endsection