@extends('layouts.app')

@section('profileCSS')
	<link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
@endsection

@section('content')
	<div class="sectionWrap">
		<div class="row">
			<div class="col s12 m4">
				<div class="card">
					<div class="center-align">
						<h4 class="spacing">Hi, I'm {{$userP->name}}</h4>
						<img src="/uploads/profilepic/{{$userP->profilepic}}" class="profilePic" id="profilePic">
						@auth
							@if($user->id == $userP->id)
							<form action="{{route('profilePic', ['id' => $userP->id])}}" enctype="multipart/form-data" method="POST" >
								@csrf
								<label for="fileUpload">
									<i class="btn-floating btn-small waves-effect waves-light orange darken-2"><i class="material-icons">create</i></i>
								</label>
								<input type="file" name="profilepic" onchange="openFileProfile(event)" class="hidden" id="fileUpload">
								<button class="btn-floating btn-small waves-effect waves-light orange darken-2" type="submit"><i class="material-icons">save</i></button>
							</form>
							@endif
						@endauth
					</div>
					<div class="card-content">
						<p class="center-align"><em>"{{$userP->tagline}}"</em></p>
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
									<h6 class="contactDetails">{{$userP->mobile}}</h6>
									@auth
										@if($user->id != $userP->id)
										<a href="#!" class="secondary-content contactBM"><i class="material-icons">bookmark_border</i></a>
										@endif
									@endauth
								</li>
								<li class="collection-item avatar">
									<i class="material-icons circle orange darken-2 contact">web</i>
									<h6 class="contactDetails">{{$userP->website}}</h6>
									@auth
										@if($user->id != $userP->id)
										<a href="#!" class="secondary-content contactBM"><i class="material-icons">bookmark_border</i></a>
										@endif
									@endauth
								</li>
								<li class="collection-item avatar">
									<i class="material-icons circle orange darken-2 contact">email</i>
									<h6 class="contactDetails">{{$userP->contact_email}}</h6>
									@auth
										@if($user->id != $userP->id)
										<a href="#!" class="secondary-content contactBM"><i class="material-icons">bookmark_border</i></a>
										@endif
									@endauth
								</li>
							</ul>
						</div>
						@auth
							@if($user->id == $userP->id)
								<div class="card-action hide-on-large-only">
									<a href="#" class="activator">Edit</a>
								</div>
							@endif
						@endauth
					</div>
					@auth
						@if($user->id == $userP->id)
							<div class="card-action hide-on-med-and-down">
								<a href="#" class="activator">Edit</a>
							</div>
						@endif
					@endauth
					<div class="card-reveal">
						<span class="card-title grey-text text-darken-4">Editing...<i class="material-icons right">close</i></span>
						<br>
						<form action="{{route('updateProfile', ['id' => $userP->id])}}" method="POST">
							@csrf
							<div class="input-field">
								<input type="text" name="name" value="{{$userP->name}}">
								<label for="name">Username</label>
							</div>
							<div class="input-field">
								<textarea class="materialize-textarea" name="tagline">{{$userP->tagline}}</textarea>
								<label for="tagline">Tagline</label>
							</div>
							<div class="input-field">
								<input type="text" name="mobile" value="{{$userP->mobile}}">
								<label for="mobile">Phone number</label>
							</div>
							<div class="input-field">
								<input type="text" name="website" value="{{$userP->website}}">
								<label for="website">Website</label>
							</div>
							<div class="input-field">
								<input type="email" name="contact_email" value="{{$userP->contact_email}}" class="validate">
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
								@if(empty($userP->detail->about))
									<span>...tell us more about yourself...</span>
								@else
									<span>{{$userP->detail->about}}</span>
								@endif
								@auth
									@if($user->id == $userP->id)
									<i class="btn-floating btn-small waves-effect waves-light orange darken-2 right"><i class="material-icons editButton" data-target="#aboutMe" data-target2="#editAboutMe">create</i></i>
									@endif
								@endauth
							</div>
							<div class="hidden row" id="editAboutMe">
								<form action="{{route('detailsUpdateAbout', ['id' => $userP->id])}}" method="POST">
									@csrf
									<div class="col m10">
										<div class="input-field">
											<textarea class="materialize-textarea" name="about">{{$userP->detail->about}}</textarea>
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
								@if(empty($userP->detail->education))
									<span>...tell us where you went...</span>
								@else
									<span>{{$userP->detail->education}}</span>
								@endif
								@auth
									@if($user->id == $userP->id)
									<i class="btn-floating btn-small waves-effect waves-light orange darken-2 right"><i class="material-icons editButton" data-target="#education" data-target2="#editEducation">create</i></i>
									@endif
								@endauth	
							</div>
							<div class="hidden row" id="editEducation">
								<form action="{{route('detailsUpdateEducation', ['id' => $userP->id])}}" method="POST">
									@csrf
									<div class="col m10">
										<div class="input-field">
											<textarea class="materialize-textarea" name="education">{{$userP->detail->education}}</textarea>
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
								@if(empty($userP->detail->work))
									<span>...tell us where you've worked...</span>
								@else
									<span>{{$userP->detail->work}}</span>
								@endif
								@auth
									@if($user->id == $userP->id)
									<i class="btn-floating btn-small waves-effect waves-light orange darken-2 right"><i class="material-icons editButton" data-target="#work" data-target2="#editWork">create</i></i>
									@endif
								@endauth	
							</div>
							<div class="hidden row" id="editWork">
								<form action="{{route('detailsUpdateWork', ['id' => $userP->id])}}" method="POST">
									@csrf
									<div class="col m10">
										<div class="input-field">
											<textarea class="materialize-textarea" name="work">{{$userP->detail->work}}</textarea>
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
												@if($user->id == $userP->id)
												<form action="{{route('deleteProduct', ['id' => $product->id])}}" method="POST">
													@csrf
													@method('DELETE')
													<button type="submit" class="btn-floating btn-small right orange darken-2 waves-effect waves-light"><i class="material-icons">delete_forever</i></button>
												</form>
												@endif
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
										@if($user->id == $userP->id)
										<a class="btn-floating btn-small waves-effect waves-light orange darken-2 spacingBottom modal-trigger right" href="#productsModal"><i class="material-icons">create</i></a>
										@endif
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
		<div class="modal-content postEnlarge">
			@if(empty($post))
			@else
				<div class="row">
					<div class="card col s12 m5 paddingOff marginTopOff">
		                <div class="card-image">
		                    <img src="/uploads/postPic/{{$post->postPic}}" class="postsPic">
		                </div>
		                <div class="card-content">
		                    <div class="row spacingBottom">
		                        <div class="col s3">
		                            <img src="/uploads/profilepic/{{$userP->profilepic}}" class="profileImage">
		                        </div>
		                        <div class="col s9">
		                            <p class="card-title">{{$userP->name}}<span class="right"><i class="material-icons modal-trigger settings" data-target="modalSettings{{$post->id}}">more_vert</i></span></p>
		                        </div>
		                    </div>
		                    <div class="modal" id="modalSettings{{$post->id}}">
		                        <div class="modal-content">
		                            <p>Settings</p>
		                        </div>
		                    </div>
		                    <div class="textarea">
		                        <br>
		                        <p><strong>{{$userP->name}}</strong> {{$post->postDescription}}</p>
		                        <br>
		                        <p class="postTimestamp">posted {{$post->created_at->diffForHumans()}}</p>
		                    </div>
		                </div>
		                <div class="card-action">
		                    <span class="left spacingBottom"><i class="material-icons">favorite</i></span>
		                    @auth
			                    @if($user->id == $userP->id)
			                    <form action="{{route('deletePost', ['id' => $post->id])}}" method="POST">
			                    	@csrf
			                    	@method('DELETE')
				                    <div class="input-field right">
			                            <button type="submit" class="btn orange darken-2">Delete</button>
			                        </div>
				                </form>
			                    @endif
			                @endauth    
		                </div>
		            </div>
		            <div class="col m1"></div>
		            <div class="col s12 m6">
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
	                    @foreach($comments as $comment)
	                        @if($comment->post_id == $post->id)
	                        <ul class="collection">
	                            <li class="collection-item">
	                                <div class="row">
	                                    <div class="col s2 m1 paddingOff">
	                                        <img src="/uploads/profilepic/{{$comment->user->profilepic}}" class="profileImageComment">
	                                    </div>
	                                    <div class="col s8 m10 paddingOff">
	                                        <p class="marginOff paddingComment paddingLeft"><strong>{{$comment->user->name}}:</strong> {{$comment->comment}}</p>
	                                    </div>
	                                    <div class="col s2 m1 paddingOff">
	                                        @auth
	                                            @if($comment->user->id == $user->id)
	                                            <form action="{{route('deleteComment', ['id' => $comment->id])}}" method="POST">
	                                                @csrf
	                                                @method('DELETE')
	                                                <div class="spacingTop">
	                                                    <button type="submit" class="btn-floating btn-small left orange darken-2 waves-effect waves-light"><i class="material-icons">delete_forever</i></button>
	                                                </div>
	                                            </form>
	                                            @endif 
	                                        @endauth
	                                    </div>
	                                </div>
	                            </li>
	                        </ul>
	                        @endif
	                    @endforeach
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