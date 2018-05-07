@extends('layouts.app')

@section('mainCSS')
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
@endsection

@section('content')
<section>
    <div class="row">
        <div class="col s12 m4">
            <div class="card">
                <div class="card-image">
                    <img src="img/merchant.jpg" class="pic">
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col s3">
                            <img src="./img/sri.jpg" class="profileImage">
                        </div>
                        <div class="col s9">
                            <p class="card-title">Sri Haji Japar<span class="right"><i class="material-icons modal-trigger settings" data-target="modalSettings">more_vert</i></span></p>
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
                        <p><strong>Sri Haji Japar</strong> Collected a bunch of these from before. Looks brand new after cleaning. Up for sale, first come, first serve!</p>
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
        <div class="col s12 m4">
            <div class="card">
                <div class="card-image">
                    <img src="img/wedding.jpg" class="pic">
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col s3">
                            <img src="./img/wedding_glam.jpg" class="profileImage">
                        </div>
                        <div class="col s9">
                            <p class="card-title">Wedding_glamour<span class="right"><i class="material-icons modal-trigger settings">more_vert</i></span></p>
                        </div>
                    </div>
                    <div class="textarea">
                        <p>Liked by <strong>Fazira</strong>, <strong>Udin</strong> and <strong>173 others</strong></p>
                        <br>
                        <p><strong>Wedding_glamour</strong> Offering professional wedding prepping services at a discounted price. Up to 75% discount for lovebirds marrying in between April till June!</p>
                        <br>
                        <p class="totalComments">53 comments in total</p>
                    </div>
                    <div class="timestamp">
                        <p>15 hours ago</p>
                    </div>
                </div>
                <div class="card-action">
                    <a href="#" class="modal-trigger">Comments</a>
                    <span class="right"><i class="material-icons">favorite</i></span>
                </div>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="card">
                <div class="card-image">
                    <img src="img/caligraphy.jpg" class="pic">
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col s3">
                            <img src="./img/wunder_artstyle.jpg" class="profileImage">
                        </div>
                        <div class="col s9">
                            <p class="card-title">Wunder Artstyle<span class="right"><i class="material-icons modal-trigger settings">more_vert</i></span></p>
                        </div>
                    </div>
                    <div class="textarea">
                        <p>Liked by <strong>Yumie</strong>, <strong>Faiz</strong> and <strong>59 others</strong></p>
                        <br>
                        <p><strong>Wunder Artstyle</strong> Be positive and rezeki will come to you. Assalamualaikum semua, Wunder Artstyle open for accepting orders. We do caligraphy, decorations and gift cards! DM or call <strong>+673 898 4532</strong> to get a quote</p>
                        <br>
                        <p><strong>Yumie</strong> So true! <strong>#SapotLokal</strong></p>
                        <br>
                        <p class="totalComments">235 comments in total</p>
                    </div>
                    <div class="timestamp">
                        <p>1 day ago</p>
                    </div>
                </div>
                <div class="card-action">
                    <a href="#" class="modal-trigger">Comments</a>
                    <span class="right"><i class="material-icons">favorite</i></span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection