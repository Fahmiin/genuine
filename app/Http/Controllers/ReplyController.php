<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;
use App\Reply;
use Auth;

class ReplyController extends Controller
{
    public function createReply(Request $request, $id)
    {
    	$reply = new Reply;
    	$user = Auth::user();
    	$comment = Comment::find($id);
    	$reply->user_id = $user->id;
    	$reply->reply = $request->input('reply');
    	$comment->replies()->save($reply);

    	return back()->with('session_code', 'replySuccess');
    }

    public function deleteReply($id)
    {
    	$reply = Reply::find($id);
    	$reply->delete();

    	return back()->with('session_code', 'deleteReplySuccess');
    }
}
