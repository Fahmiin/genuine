<div class="fixed-action-btn">
    @auth
    <a class="btn-floating orange darken-4 btn-large"><i class="large material-icons">home</i></a>
    <ul>
        <li><a href="#newPostModal" class="btn-floating orange darken-4 btn-large modal-trigger"><i class="large material-icons">edit</i></a></li>
        <li><a href="#searchModal" class="btn-floating orange darken-4 btn-large modal-trigger hide-on-large-only"><i class="large material-icons">search</i></a></li>
        <li><a href="/tags" class="btn-floating orange darken-4 btn-large modal-trigger"><i class="large material-icons">local_offer</i></a></li>
        <li><a href="#" class="btn-floating orange darken-4 btn-large modal-trigger hide-on-med-and-down"><i class="large material-icons">notifications</i></a></li>
    </ul>
    @else
    <a class="btn-floating orange darken-4 btn-large"><i class="large material-icons">add</i></a>
    <ul>
        <li><a class="btn-floating orange darken-4 btn-large modal-trigger hide-on-large-only" href="#searchModal"><i class="large material-icons">search</i></a></li>
        <li><a href="/tags" class="btn-floating orange darken-4 btn-large modal-trigger"><i class="large material-icons">local_offer</i></a></li>
    </ul>
    @endauth
</div>

<div class="modal" id="newPostModal">
	<div class="modal-content">
		<h4 class="center">Share a new post</h4>
		<form action="{{route('createPost')}}" method="POST" enctype="multipart/form-data">
			@csrf
            <div class="input-field">
       			<div class="center">
            		<img id="postPic">
            	</div>
            	<div class="center">
	            	<label for="postUpload" class="btn orange darken-2"><i class="material-icons left">file_upload</i>Upload</label>
	            	<input type="file" name="postPic" onchange="openFile(event)" class="hidden" id="postUpload" required>
	            </div>
            </div>
            <div class="input-field">
                <textarea class="materialize-textarea" name="postDescription" required></textarea>
				<label for="postDescription">Description</label>
            </div>
            <div class="input-field-tags">
                <label for="tags[]">Enter Tags</label>
                <select class="select2" name="tags[]" multiple="multiple" required>
                    @foreach(\App\Tag::all() as $tag)
                        <option value="{{$tag->id}}">{{$tag->tag}}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-field center-align">
                <button type="submit" class="btn orange darken-2">Share</button>
            </div>
		</form>
	</div>
</div>

<div class="modal" id="searchModal">
    <div class="modal-content">
        <h4 class="center">Search for a user</h4>
        <form action="{{route('liveSearch')}}" method="GET">
            @csrf
            <div class="input-field">
                <input type="search" id="search2" class="searchBarModal" placeholder="Your search begins here..." name="search" required>
                <ul class="searchResults collection hidden searchDropdown"></ul>
            </div>
        </form>
    </div>
</div>
