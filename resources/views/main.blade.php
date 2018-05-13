@extends('layouts.app')

@section('mainCSS')
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
@endsection

@section('content')
<section>
    <div class="row">
        @foreach($posts as $post)
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
                            <p class="card-title"><a href="profile/{{$post->user->id}}" class="profileLinkMain">{{$post->user->name}}</a><span class="right"><i class="material-icons modal-trigger settings" data-target="modalSettings">more_vert</i></span></p>
                        </div>
                    </div>
                    <div class="modal" id="modalSettings">
                        <div class="modal-content">
                            <p>Settings</p>
                        </div>
                    </div>
                    <div class="textarea">
                        <p>Liked by <strong>Mat</strong>, <strong>Quddus</strong> and <strong>26 others</strong></p>
                        <br>
                        <p><strong>{{$post->user->name}}</strong> {{$post->postDescription}}</p>
                        <br>
                        <p class="totalComments">36 comments in total</p>
                    </div>
                    <div class="timestamp">
                        <p>30 mins ago</p>
                    </div>
                </div>
                <div class="card-action">
                    <a href="#modalComment" class="modal-trigger">Comments</a>
                    <span class="right"><i class="material-icons">favorite</i></span>
                </div>
            </div>

            <div id="modalComment" class="modal">
                <div class="modal-content">
                    <p>Comments</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection