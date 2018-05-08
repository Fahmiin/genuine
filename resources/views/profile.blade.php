@extends('layouts.app')

@section('profileCSS')
	<link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
@endsection

@section('mainCSS')
	<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
@endsection

@section('content')
	<div class="sectionWrap">
		<div class="row">
			<div class="col s12 m4">
				<div class="card">
					<div class="center-align">
						<h4 class="spacing">Hi, I'm {{$user->name}}</h4>
						<img src="/uploads/profilepic/{{$user->profilepic}}" class="profilePic responsive-img">
						<form action="{{route('profilePic', ['id' => $user->id])}}" enctype="multipart/form-data" method="POST" >
							@csrf
							<label for="fileUpload">
								<i class="btn-floating btn-small waves-effect waves-light orange darken-2"><i class="material-icons">create</i></i>
							</label>
							<input type="file" name="profilepic" id="fileUpload" >
							<button class="btn-floating btn-small waves-effect waves-light orange darken-2" type="submit"><i class="material-icons">save</i></button>
						</form>
					</div>
					<div class="card-content">
						<p class="center-align"><em>"{{$user->tagline}}"</em></p>
					</div>
					<div class="card-action hide-on-large-only">
						<a id="seeMoreProfile">See more</a>
					</div>
					<div class="hide-on-med-and-down" id="seeMore">
						<div class="card-action">
							<h6 class="center-align">Rated</h6>
							<p class="spacing center-align">
								<span><i class="material-icons">star</i></span>
								<span><i class="material-icons">star</i></span>
								<span><i class="material-icons">star</i></span>
								<span><i class="material-icons">star</i></span>
								<span><i class="material-icons">star</i></span>
							</p>
						</div>
						<div class="card-action">
							<h6 class="center-align spacing">Speed Contact</h6>
							<ul class="collection black-text">
								<li class="collection-item avatar">
									<i class="material-icons circle orange darken-2 contact">phone_android</i>
									<h6 class="contactDetails">{{$user->mobile}}</h6>
									<a href="#!" class="secondary-content contactBM"><i class="material-icons">bookmark_border</i></a>
								</li>
								<li class="collection-item avatar">
									<i class="material-icons circle orange darken-2 contact">web</i>
									<h6 class="contactDetails">{{$user->website}}</h6>
									<a href="#!" class="secondary-content contactBM"><i class="material-icons">bookmark_border</i></a>
								</li>
								<li class="collection-item avatar">
									<i class="material-icons circle orange darken-2 contact">email</i>
									<h6 class="contactDetails">{{$user->contact_email}}</h6>
									<a href="#!" class="secondary-content contactBM"><i class="material-icons">bookmark_border</i></a>
								</li>
							</ul>
						</div>
						@guest
						@else
							<div class="card-action hide-on-large-only">
								<a href="#" class="activator">Edit</a>
							</div>
						@endguest
					</div>
					@guest
					@else
						<div class="card-action hide-on-med-and-down">
							<a href="#" class="activator">Edit</a>
						</div>
					@endguest
					<div class="card-reveal">
						<span class="card-title grey-text text-darken-4">Editing...<i class="material-icons right">close</i></span>
						<br>
						<form action="{{route('updateProfile', ['id' => $user->id])}}" method="POST">
							@csrf
							<div class="input-field">
								<input type="text" name="name" value="{{$user->name}}">
								<label for="name">Username</label>
							</div>
							<div class="input-field">
								<textarea class="materialize-textarea" name="tagline">{{$user->tagline}}</textarea>
								<label for="tagline">Tagline</label>
							</div>
							<div class="input-field">
								<input type="text" name="mobile" value="{{$user->mobile}}">
								<label for="mobile">Phone number</label>
							</div>
							<div class="input-field">
								<input type="text" name="website" value="{{$user->website}}">
								<label for="website">Website</label>
							</div>
							<div class="input-field">
								<input type="email" name="contact_email" value="{{$user->contact_email}}" class="validate">
								<label for="contact_email">Email</label>
							</div>
							<div class="input-field center-align">
                                <button class="btn-floating btn-medium waves-effect waves-light orange darken-2" type="submit"><i class="material-icons">save</i></button>
                            </div>
						</form>
					</div>
				</div>
			</div>

			<div class="col s12 m8">
				<ul class="collapsible">
					<li class="active">
						<div class="collapsible-header"><i class="material-icons">person</i>About me</div>
						<div class="collapsible-body">
							<div id="aboutMe">
								@if(empty($user->detail->about))
									<span>...tell us more about yourself...</span>
								@else
									<span>{{$user->detail->about}}</span>
								@endif
								@auth
								<i class="btn-floating btn-small waves-effect waves-light orange darken-2 right"><i class="material-icons editButton" data-target="#aboutMe" data-target2="#editAboutMe">create</i></i>
								@endauth
							</div>
							<div class="hidden row" id="editAboutMe">
								<form action="{{route('detailsUpdateAbout', ['id' => $user->id])}}" method="POST">
									@csrf
									<div class="col m10">
										<div class="input-field">
											<textarea class="materialize-textarea" name="about">{{$user->detail->about}}</textarea>
											<label for="about">About Me</label>
										</div>
									</div>
									<div class="col m2">
										<button class="btn-floating btn-small waves-effect waves-light orange darken-2 right" type="submit"><i class="material-icons">save</i></button>
									</div>
								</form>
								<div class="center-align">
									<a class="saveButton right spacing" data-target="#aboutMe" data-target2="#editAboutMe"><strong>Cancel</strong></a>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="collapsible-header"><i class="material-icons">laptop_chromebook</i>My education</div>
						<div class="collapsible-body">
							<div id="education">
								@if(empty($user->detail->education))
									<span>...tell us where you went...</span>
								@else
									<span>{{$user->detail->education}}</span>
								@endif
								@auth
								<i class="btn-floating btn-small waves-effect waves-light orange darken-2 right"><i class="material-icons editButton" data-target="#education" data-target2="#editEducation">create</i></i>
								@endauth
							</div>
							<div class="hidden row" id="editEducation">
								<form action="{{route('detailsUpdateEducation', ['id' => $user->id])}}" method="POST">
									@csrf
									<div class="col m10">
										<div class="input-field">
											<textarea class="materialize-textarea" name="education">{{$user->detail->education}}</textarea>
											<label for="education">My education</label>
										</div>
									</div>
									<div class="col m2">
										<button class="btn-floating btn-small waves-effect waves-light orange darken-2 right" type="submit"><i class="material-icons">save</i></button>
									</div>
								</form>
								<div class="center-align">
									<a class="saveButton right spacing" data-target="#education" data-target2="#editEducation"><strong>Cancel</strong></a>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="collapsible-header"><i class="material-icons">work</i>My work experience</div>
						<div class="collapsible-body">
							<div id="work">
								@if(empty($user->detail->work))
									<span>...tell us where you've worked...</span>
								@else
									<span>{{$user->detail->work}}</span>
								@endif
								@auth
								<i class="btn-floating btn-small waves-effect waves-light orange darken-2 right"><i class="material-icons editButton" data-target="#work" data-target2="#editWork">create</i></i>
								@endauth
							</div>
							<div class="hidden row" id="editWork">
								<form action="{{route('detailsUpdateWork', ['id' => $user->id])}}" method="POST">
									@csrf
									<div class="col m10">
										<div class="input-field">
											<textarea class="materialize-textarea" name="work">{{$user->detail->work}}</textarea>
											<label for="work">My work experience</label>
										</div>
									</div>
									<div class="col m2">
										<button class="btn-floating btn-small waves-effect waves-light orange darken-2 right" type="submit"><i class="material-icons">save</i></button>
									</div>
								</form>
								<div class="center-align">
									<a class="saveButton right spacing" data-target="#work" data-target2="#editWork"><strong>Cancel</strong></a>
								</div>
							</div>
						</div>
					</li>
					<li class="active">
						<div class="collapsible-header productsHeader"><i class="material-icons">shopping_cart</i>My products</div>
						<div class="hide-on-med-and-down productsBody">
							<div class="body">
								@foreach($products as $product)
								<div class="col s12 m6">
									<div class="card blue-grey darken-1">
										<div class="card-content white-text">
											<span class="card-title">{{$product->productTitle}}</span>
											@auth
											<form action="{{route('deleteProduct', ['id' => $product->id])}}" method="POST">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn-floating btn-small right orange darken-2 waves-effect waves-light"><i class="material-icons">close</i></button>
											</form>
											@endauth
											<p>{{$product->productDescription}}</p>
										</div>
										<div class="card-action">
											<a>{{$product->productPricing}}</a>
										</div>
									</div>
								</div>
								@endforeach
							</div>
							<div class="editProductsButton">
								<div></div>
								<div>
									@auth
									<a class="btn-floating btn-small waves-effect waves-light orange darken-2 spacingBottom modal-trigger right" href="#productsModal"><i class="material-icons">create</i></a>
									@endauth
								</div>
								<div></div>
							</div>
						</div>
					</li>
					<li>
						<div class="collapsible-header"><i class="material-icons">star_rate</i>My reviews</div>
						<div class="collapsible-body">
							<span>No reviews yet</span>
						</div>
					</li>
				</ul>
				<ul class="collapsible">
					<li>
						<div class="collapsible-header"><i class="material-icons">content_paste</i>Recent Posts</div>
						@if(empty($posts))
						@else
						<div class="postsCollectionBody">
							@foreach($posts as $post)
							<div class="postsCollection">
								<img class="postsCollectionImage modal-trigger" href="#postModal{{$post->id}}" src="/uploads/postPic/{{$post->postPic}}">
							</div>
							@endforeach
						</div>
						@endif
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="modal" id="productsModal">
		<div class="modal-content">
			<h4 class="center">Add a new product or service</h4>
			<div class="row">
                <div class="col s12">
                    <form action="{{route('createProduct')}}" method="POST">
                        @csrf
                        <div class="input-field">
                            <input type="text" name="productTitle" required>
                            <label for="productTitle">Product or Service</label>
                        </div>
                        <div class="input-field">
                        	<textarea class="materialize-textarea" name="productDescription" required></textarea>
							<label for="productDescription">Description</label>
                        </div>
                        <div class="input-field">
                        	<input type="text" name="productPricing" placeholder="Enter a reasonable price" required>
                            <label for="productPricing">Pricing</label>
                        </div>
                        <div class="input-field center-align">
                            <button type="submit" class="btn orange darken-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>

	@foreach($posts as $post)
	<div class="modal maxWrap" id="postModal{{$post->id}}">
		<div class="modal-content">
			@if(empty($post))
			@else
				<div class="row">
					<div class="card col s12 m5 paddingOff">
		                <div class="card-image">
		                    <img src="/uploads/postPic/{{$post->postPic}}" class="postsPic">
		                </div>
		                <div class="card-content">
		                    <div class="row">
		                        <div class="col s3">
		                            <img src="/uploads/profilepic/{{$user->profilepic}}" class="profileImage">
		                        </div>
		                        <div class="col s9">
		                            <p class="card-title">{{$user->name}}<span class="right"><i class="material-icons modal-trigger settings" data-target="modalSettings">more_vert</i></span></p>
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
		                        <p><strong>{{$user->name}}</strong> {{$post->postDescription}}</p>
		                        <br>
		                        <p class="totalComments">36 comments in total</p>
		                    </div>
		                    <div class="timestamp">
		                        <p>30 mins ago</p>
		                    </div>
		                </div>
		                <div class="card-action">
		                    <span class="left spacingBottom"><i class="material-icons">favorite</i></span>
		                    @auth
		                    <form action="{{route('deletePost', ['id' => $post->id])}}" method="POST">
		                    	@csrf
		                    	@method('DELETE')
			                    <div class="input-field right">
		                            <button type="submit" class="btn orange darken-2">Delete</button>
		                        </div>
			                </form>
		                    @endauth
		                </div>
		            </div>
		            <div class="col s12 m7">
		            	<h4 class="center">Comments Here</h4>
		            </div>
		        </div>
            @endif
        </div>
	</div>
	@endforeach
@endsection

@section('profileJS')
	 <script src="{{asset('js/profile.js')}}"></script>
@endsection