@extends('layouts.app')

@section('CSS')
    <link rel="stylesheet" type="text/css" href="{{asset('css/tag.css')}}">
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col s12 m7">
				<form action="{{route('searchTags')}}" method="GET">
					@csrf
					<div class="input-field">
						<input type="search" placeholder="Search for a Tag..." class="tagSearch" id="searchTag">
					</div>
				</form>
				<div class="collection tagSearchResults hidden"></div>
			</div>
			<div class="col s12 m5">
				@auth
				<div class="card">
					<form action="{{route('createTag')}}" method="POST">
						@csrf
						<div class="card-content">
							<span class="card-title center-align">Create a new Tag for our users!</span>
							<br>
							<div class="input-field">
	                            <input type="text" name="tag" required>
	                            <label for="tag">A tag starts with a # and a capital letter</label>
	                        </div>
	                        <div class="input-field center-align">
	                        	<button type="submit" class="btn orange darken-2">Submit</button>
	                        </div>
						</div>
					</form>
				</div>
				@endauth
				<div class="card">
					<div class="card-content">
						<span class="card-title center-align">Popular tags</span>
						<br>
						@foreach($tags as $tag)
							<div class="chip">
								<a href="/tag/{{$tag->id}}" id="searchTagID"">{{$tag->tag}}</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('JS')
	 <script src="{{asset('js/tag.js')}}"></script>
@endsection