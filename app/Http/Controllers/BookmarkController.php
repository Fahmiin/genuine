<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Bookmark;
use Auth;

class BookmarkController extends Controller
{
	public function showContacts()
	{
		if(Auth::check())
		{
			$user = Auth::user();
			$contacts = Bookmark::where('user_id', $user->id)
									->where('status', true)
									->paginate(10);

			return view('contacts')->with('contacts', $contacts);
		}

		return back();
	}

	public function quickView(Request $request)
	{
		if($request->ajax())
		{
			$userP_id = $request->get('userid');
			$userP = User::find($userP_id);
			$output = "";

			if($userP)
			{
				$output .=

'<div class="row">
	<div class="col s12 m6">
	<h4 class="center">Hi, I\'m '.$userP->name.'</h4>
		<div class="card">
			<div class="center-align">
				<img src="/uploads/profilepic/'.$userP->profilepic.'" class="profilePic" id="profilePic">
			</div>
			<div class="card-content">
				<p class="center-align"><em>"'.$userP->tagline.'"</em></p>
			</div>
			<div class="card-action center-align">
				<span><i class="material-icons">star</i></span>
				<span><i class="material-icons">star</i></span>
				<span><i class="material-icons">star</i></span>
				<span><i class="material-icons">star</i></span>
				<span><i class="material-icons">star</i></span>
			</div>
		</div>
	</div>
	<div class="col s12 m6">
		<div class="card">
			<div class="card-content">
				<a href="/profile/'.$userP->id.'" class="btn orange darken-2 waves-effect waves-light"><i class="material-icons right">arrow_forward</i>View Full Page</a>
				<h6 class="center-align spacing">Speed Contact</h6>
				<ul class="collection black-text">
					<li class="collection-item avatar">
						<i class="material-icons circle orange darken-2 contact">phone_android</i>
						<h6 class="contactDetails">'.$userP->mobile.'</h6>
					</li>
					<li class="collection-item avatar">
						<i class="material-icons circle orange darken-2 contact">web</i>
						<h6 class="contactDetails">'.$userP->website.'</h6>
					</li>
					<li class="collection-item avatar">
						<i class="material-icons circle orange darken-2 contact">email</i>
						<h6 class="contactDetails">'.$userP->contact_email.'</h6>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>';

				return response($output);
			}
		}
	}

    public function createFavourite(Request $request)
    {
    	if ($request->ajax())
    	{
			$userP_id = $request->get("userP_id");
			$userP = User::find($userP_id);
			$user = Auth::user();
			$isBookmarked = Bookmark::where('userP_id', $userP_id)
	    								->where('user_id', $user->id)
	    								->first();

	    	if($isBookmarked === null)
	    	{
	    		$bookmark = new Bookmark;
	    		$bookmark->userP_id = $userP_id;
		    	$bookmark->status = true;
		    	$user->bookmarks()->save($bookmark);

		    	return response('faved');
	    	}

	    	$isBookmarked->delete();

	    	return response('unfaved');
    	}
    }

}
