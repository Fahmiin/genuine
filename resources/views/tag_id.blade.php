@extends('layouts.app')

@section('CSS')
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
@endsection

@section('content')
	<div class="center-align">
		<h5>Posts related to {{$tag->tag}}</h5>
		<hr>
	</div>
    <div class="row">
        @foreach($tag->posts as $post)
        <div class="col s12 m4">
            <div class="card">
                <div class="card-image">
                    <img src="/uploads/postPic/{{$post->postPic}}" class="postsPic">
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col s3">
                            <img src="/uploads/profilepic/{{$post->user->profilepic}}" class="profileImage">
                        </div>
                        <div class="col s9">
                            <p class="card-title"><a href="../profile/{{$post->user->id}}" class="profileLinkMain">{{$post->user->name}}</a><span class="right"><i class="material-icons modal-trigger settings" data-target="modalSettings{{$post->user->id}}">more_vert</i></span></p>
                        </div>
                    </div>
                    <div class="modal" id="modalSettings{{$post->user->id}}">
                        <div class="modal-content">
                            <p>Settings</p>
                        </div>
                    </div>
                    <div class="textarea">
                        <br>
                        <p><strong>{{$post->user->name}}</strong> {{$post->postDescription}}</p>
                        <br>
                        <span>@foreach($post->tags as $tag)
                            <div class="chip">
                                <a href="/tag/{{$tag->id}}" id="searchTagID"">{{$tag->tag}}</a>
                            </div>
                        @endforeach</span>
                        <br>
                        <p class="postTimestamp">posted {{$post->created_at->diffForHumans()}}</p>
                        <br>
                        <p class="postTimestamp">{{$post->comments->count()}} total comments</p>
                    </div>
                </div>
                <div class="card-action">
                    <a href="#modalComment{{$post->id}}" class="modal-trigger">Comments</a>
                    <span class="right"><i class="material-icons">favorite</i></span>
                </div>
            </div>

            <div id="modalComment{{$post->id}}" class="modal">
                <div class="modal-content">
                    @auth
                    <form action="{{route('createComment', ['id' => $post->id])}}" method="POST">
                        @csrf
                         <div class="input-field">
                            <textarea class="materialize-textarea" name="comment" required></textarea>
                            <label for="comment">Tell {{$post->user->name}} what you think</label>
                        </div>
                        <div class="input-field center-align">
                            <button type="submit" class="btn orange darken-2">Submit</button>
                        </div>
                    </form>
                    @else
                    <h5 class="center-align">Please log in to comment</h5>
                    @endauth
                    <div>
                        <h5>Comments</h5>
                    </div>
                    @foreach($post->comments as $comment)
                    <ul class="collection">
                        <li class="collection-item">
                            <div class="row">
                                <div class="col s2 m1 paddingOff">
                                    <img src="/uploads/profilepic/{{$comment->user->profilepic}}" class="profileImageComment">
                                </div>
                                <div class="col s8 m10 paddingOff">
                                    <p class="marginOff paddingComment"><strong>{{$comment->user->name}}:</strong> {{$comment->comment}}</p>
                                </div>
                                <div class="col s2 m1 paddingOff">
                                    @auth
                                        @if($comment->user->id == $user->id)
                                        <form action="{{route('deleteComment', ['id' => $comment->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="spacingTop">
                                                <button type="submit" class="btn-floating btn-small right orange darken-2 waves-effect waves-light"><i class="material-icons">delete_forever</i></button>
                                            </div>
                                        </form>
                                        @endif 
                                    @endauth
                                </div>
                            </div>
                        </li>
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection