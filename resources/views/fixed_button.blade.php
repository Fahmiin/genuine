<div class="fixed-action-btn">
    @auth
    <a class="btn-floating orange darken-4 btn-large"><i class="large material-icons">home</i></a>
    <ul>
        <li><a href="#" class="btn-floating orange darken-4 btn-large tooltipped modal-trigger" data-position="left" data-tooltip="Private message"><i class="large material-icons">chat</i></a></li>
        <li><a href="#newPostModal" class="btn-floating orange darken-4 btn-large tooltipped modal-trigger" data-position="left" data-tooltip="New post"><i class="large material-icons">edit</i></a></li>
        <li><a href="#searchModal" class="btn-floating orange darken-4 btn-large tooltipped modal-trigger hide-on-large-only" data-position="left" data-tooltip="Search"><i class="large material-icons">search</i></a></li>
        <li><a href="#" class="btn-floating orange darken-4 btn-large tooltipped modal-trigger" data-position="left" data-tooltip="Notifications"><i class="large material-icons">notifications</i></a></li>
    </ul>
    @else
    <a class="btn-floating orange darken-4 btn-large modal-trigger hide-on-large-only" href="#searchModal"><i class="large material-icons">search</i></a>
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
	            	<input type="file" name="postPic" onchange="openFile(event)" class="hidden" id="postUpload">
	            </div>
            </div>
            <div class="input-field">
                <textarea class="materialize-textarea" name="postDescription"></textarea>
				<label for="postDescription">Description</label>
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
        <form action="{{route('searchUsers')}}" method="POST">
            @csrf
            <div class="input-field">
                <input type="search" id="search" class="searchBarModal" placeholder="Your search begins here..." name="search" required>
                <div class="center-align">
                    <button class="btn waves-effect waves-light orange darken-2 searchButtonModal" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
