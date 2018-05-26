@extends('layouts.app')

@section('CSS')
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
@endsection

@section('content')
    <div class="row">
        @foreach($posts as $post)
        <div class="col s12 m4">
            <div class="card">
                <div class="card-image">
                    <img src="/uploads/postPic/{{$post->postPic}}" class="postsPic">
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col s3 m3">
                            <img src="/uploads/profilepic/{{$post->user->profilepic}}" class="profileImage">
                        </div>
                        <div class="col s9 m9">
                            <p class="card-title"><a href="profile/{{$post->user->id}}" class="profileLinkMain">{{$post->user->name}}</a><span class="right"><i class="material-icons modal-trigger settings" data-target="modalSettings{{$post->user->id}}">more_vert</i></span></p>
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
                        <p class="postTimestamp left">posted {{$post->created_at->diffForHumans()}}</p>
                        <p class="postTimestamp right">{{$post->comments->count()}} total comments</p>
                    </div>
                </div>
                <div class="card-action">
                    <a href="#modalComment{{$post->id}}" class="modal-trigger">Comments</a>
                    <a class="right"><i class="material-icons black-text like
                        @auth
                        @foreach($user->likes as $like)
                            {{($like->post_id == $post->id) ? 'liked' : ''}}
                        @endforeach
                        @endauth" data-post="{{$post->id}}" id="like{{$post->id}}">favorite</i></a>
                    <span class="right marginRightSmall">{{$post->likes->count()}}</span>
                </div>
            </div>

            <div id="modalComment{{$post->id}}" class="modal maxWrapSmall">
                <div class="modal-content postEnlarge">
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
                                <div class="col s2 m2 paddingOff center-align">
                                    <img src="/uploads/profilepic/{{$comment->user->profilepic}}" class="profileImageComment">
                                </div>
                                <div class="col s8 m9 paddingOff">
                                    <p class="marginOff paddingComment"><strong>{{$comment->user->name}}:</strong> {{$comment->comment}}</p>
                                    <p class="postTimestamp marginOff">{{$comment->created_at->diffForHumans()}}</p>
                                </div>
                                <div class="col s2 m1 paddingOff">
                                    @auth
                                        @if($user->id == $comment->user->id)
                                        <form action="{{route('deleteComment', ['id' => $comment->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="spacingTop">
                                                <button type="submit" class="btn-floating btn-small right orange darken-2 waves-effect waves-light"><i class="material-icons">delete_forever</i></button>
                                            </div>
                                        </form>
                                        @else
                                        <a data-reply="#reply{{$comment->id}}" data-comment="#comment{{$comment->id}}" class="right paddingTop reply" id="reply{{$comment->id}}">Reply</a>
                                        @endif     
                                    @endauth
                                </div>
                            </div>
                            @auth
                                @if($user->id != $comment->user->id)
                                <div class="row hidden" id="comment{{$comment->id}}">
                                    <form action="{{route('createReply', ['id' => $comment->id])}}" method="POST">
                                        @csrf
                                        <div class="col s11 m11">
                                            <div class="input-field">
                                                <textarea class="materialize-textarea" name="reply" required></textarea>
                                                <label for="reply">You are replying to {{$comment->user->name}}</label>
                                            </div>
                                        </div>
                                        <div class="col s1 m1">
                                            <div class="input-field center-align">
                                                <button class="btn-floating btn-small waves-effect waves-light orange darken-2" type="submit"><i class="material-icons">save</i></button>
                                            </div>
                                            <a data-reply="#reply{{$comment->id}}" data-comment="#comment{{$comment->id}}" class="cancelReply">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                                @endif
                            @endauth
                        </li>
                        @foreach($comment->replies as $reply)
                        <div class="marginLeft replyBox">
                            <li class="collection-item paddingSmall">
                                <div class="row">
                                    <div class="col m1 hide-on-med-and-down">
                                        <i class="small material-icons spacingTop">reply</i>
                                    </div>
                                    <div class="col s2 m1 paddingOff spacingTop">
                                        <img src="/uploads/profilepic/{{$reply->user->profilepic}}" class="profileImageComment right">
                                    </div>
                                    <div class="col s7 m8 paddingOff">
                                        <p class="marginOff paddingComment spaceAbove"><strong>{{$reply->user->name}}:</strong> {{$reply->reply}}</p>
                                        <p class="postTimestamp marginOff">{{$reply->created_at->diffForHumans()}}</p>
                                    </div>
                                    <div class="col s3 m2 paddingOff">
                                        @auth
                                            @if($reply->user->id == $user->id)
                                            <form action="{{route('deleteReply', ['id' => $reply->id])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="spacingTop center-align paddingLeftSmall">
                                                    <button type="submit" class="btn-floating btn-small orange darken-2 waves-effect waves-light"><i class="material-icons">delete_forever</i></button>
                                                </div>
                                            </form>
                                            @endif     
                                        @endauth
                                    </div>
                                </div>
                            </li>
                        </div>
                        @endforeach
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection