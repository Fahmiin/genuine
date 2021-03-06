@extends('layouts.app')

@section('CSS')
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
						@auth
							@if($user->id == $userP->id)
							@else
							<div class="card-action">
								<button class="btn waves-effect waves-light follow orange darken-2
								@auth
								@foreach($user->bookmarks as $bookmark)
		                            {{($bookmark->userP_id == $userP->id) ? 'blue-grey darken-1 white-text' : ''}}
		                        @endforeach
								@endauth
								" data-userid="{{$userP->id}}" id="follow{{$userP->id}}"><i class="material-icons left">person_add</i>
								@auth
								@foreach($user->bookmarks as $bookmark)
		                            {{($bookmark->userP_id == $userP->id) ? 'Unfollow' : ''}}
		                   		@endforeach
								@endauth</button>
							</div>
							@endif
						@endauth
						<div class="card-action">
							<h6 class="center-align">Rated</h6>
							<p class="spacing center-align">
								<span><i class="material-icons">star</i></span>
								<span><i class="material-icons">star</i></span>
								<span><i class="material-icons">star</i></span>
								<span><i class="material-icons">star</i></span>
								<span><i class="material-icons">star</i></span>
							</p>
							@auth
								@if($user->id != $userP->id)
								<a href="#reviewModal" class="modal-trigger reviewLink">Write a review</a>
								@endif
							@endauth	
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
								@foreach($userP->products as $product)
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
						<div class="collapsible-body paddingOff">
							@if(empty($userP->reviews))
							@else
							<ul class="collection">
								@foreach($userP->reviews as $review)
								<li class="collection-item reviewBoxes">
									<div class="row">
										<div class="col s2 m1 center-align">
											<img src="/uploads/profilepic/{{$review->user->profilepic}}" class="circle">
										</div>
										<div class="col s9 m10 spaceTop">
											<span><strong>{{$review->user->name}}</strong>: <em>"{{$review->review}}"</em></span>
										</div>
										<div class="col s1 m1 right spaceTop">
											@auth
												@if($review->user->id == $user->id)
												<form action="{{route('deleteReview', ['id' => $review->id])}}" method="POST">
													@csrf
													@method('DELETE')
													<button type="submit" class="btn-floating btn-small right orange darken-2 waves-effect waves-light"><i class="material-icons">delete_forever</i></button>
												</form>
												@endif
											@endauth	
										</div>
									</div>
								</li>
								@endforeach
							</ul>
							@endif
						</div>
					</li>
				</ul>
				<ul class="collapsible">
					<li>
						<div class="collapsible-header"><i class="material-icons">content_paste</i>Recent Posts</div>
						@if(empty($userP->posts))
						@else
						<div class="postsCollectionBody">
							@foreach($userP->posts->sortByDesc('id') as $post)
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

	<div class="modal" id="reviewModal">
		<div class="modal-content">
			<h4 class="center">Write a review for {{$userP->name}}</h4>
			<form action="{{route('createReview', ['id' => $userP->id])}}" method="POST">
				@csrf
				<div class="input-field">
					<textarea class="materialize-textarea" name="review" required></textarea>
				</div>
				<div class="input-field center-align">
					<button type="submit" class="btn orange darken-2">Submit</button>
				</div>
			</form>
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

	@foreach($userP->posts as $post)
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
		                    <div class="row">
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
		                        <p id="description{{$post->id}}"><strong>{{$userP->name}}</strong> {{$post->postDescription}}</p>
		                        <div class="hidden" id="post{{$post->id}}">
		                        	<form action="{{route('editPost', ['id' => $post->id])}}" method="POST">
		                        		@csrf
		                        		<div class="input-field">
			                        		<textarea name="editPost" class="materialize-textarea">{{$post->postDescription}}</textarea>
			                        		<label for="editPost">Edit your post</label>
			                        	</div>
			                        	<div class="input-field">
			                        		<button class="btn-floating btn-small waves-effect waves-light orange darken-2 right" type="submit"><i class="material-icons">save</i></button>
			                        	</div>
		                        	</form>
									<a class="cancelEditPost" data-id="#post{{$post->id}}" data-hide="#description{{$post->id}}" data-edit="#edit{{$post->id}}"><strong>Cancel</strong></a>
		                        </div>
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
		                <div class="card-action cardPost">
		                	<div class="row">
		                		<div class="col s3 m2">
		                			<a class="left spacingBottom marginRightSmall"><i class="material-icons black-text like
				                        @auth
				                        @foreach($user->likes as $like)
				                            {{($like->post_id == $post->id) ? 'liked' : ''}}
				                        @endforeach
				                        @endauth" data-post="{{$post->id}}" id="like{{$post->id}}">favorite</i></a>
				                    <span>{{$post->likes->count()}}</span>
				               	</div>
			                    @auth
				                    @if($user->id == $userP->id)
				                    <div class="col s6 m7">
				                    	<button class="waves-effect waves-light btn orange darken-2 right editPost" data-id="#post{{$post->id}}" data-hide="#description{{$post->id}}" id="edit{{$post->id}}">Edit</button>
				                    </div>
				                    <div class="col s3 m3">
					                    <a class="waves-effect waves-light btn modal-trigger orange darken-2 right" href="#deleteConfirm{{$post->id}}">Delete</a>
					                </div>
				                    @endif
				                @endauth
				            </div>  
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
                                        <div class="col s3 m2 paddingOff spacingTop center-align">
                                            <img src="/uploads/profilepic/{{$reply->user->profilepic}}" class="profileImageComment">
                                        </div>
                                        <div class="col s6 m7 paddingOff">
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
            @endif
        </div>
	</div>
	
	<div class="modal" id="deleteConfirm{{$post->id}}">
		<div class="modal-content">
			<div class="center-align">
				<h5>Are you sure you want to delete this post?</h5>
			</div>
			<div class="row">
				<div class="col s6 m6 center-align">
					<form action="{{route('deletePost', ['id' => $post->id])}}" method="POST">
	                	@csrf
	                	@method('DELETE')
	                    <div class="input-field">
	                        <button type="submit" class="btn orange darken-2">Delete</button>
	                    </div>
	                </form>
				</div>
				<div class="col s6 m6 center-align">
					<div class="input-field">
						<a href="/profile" class="btn orange darken-2">Cancel</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
@endsection

@section('JS')
	 <script src="{{asset('js/profile.js')}}"></script>
@endsection