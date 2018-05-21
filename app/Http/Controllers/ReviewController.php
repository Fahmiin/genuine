<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Review;
use Auth;

class ReviewController extends Controller
{
    public function createReview(Request $request, $id)
    {
    	$request->validate(
		[
			'review' => 'required|max:255'
		]);

    	$review = new Review;
    	$userP = User::find($id);
        $user = Auth::user();
    	$review->userP_id = $userP->id;
        $review->user_id = $user->id;
    	$review->review = $request->input('review');
    	$userP->reviews()->save($review);

    	return back()->with('session_code', 'reviewSuccess');
    }

    public function deleteReview($id)
    {
        $review = Review::find($id);
        $review->delete();

        return back()->with('session_code', 'deleteReviewSuccess');
    }
}
