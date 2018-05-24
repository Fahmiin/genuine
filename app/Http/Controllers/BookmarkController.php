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
			$contacts = Bookmark::paginate(10);

			return view('contacts')
				->with('user', $user)
				->with('contacts', $contacts);
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

    public function createBlock(Request $request)
    {
    	if ($request->ajax())
    	{
	    	$userP = User::find($id);
	    	$user = Auth::user();
	    	$isBookmarked = Bookmark::find('userP_id', $userP->id)->first();

	    	if($isBookmarked === null)
	    	{
	    		$bookmark = new Bookmark;
	    		$bookmark->userP_id = $userP->id;
		    	$bookmark->status = false;
		    	$user->bookmarks()->save($bookmark);

		    	return response('blocked');
	    	}

	    	$isBookmarked->delete();

	    	return response('unblocked');
    	}
    }
}
