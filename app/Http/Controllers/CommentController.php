<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    public function createComment(Request $request, $id)
    {
    	$this->validate(request(),
		[
			'comment' => 'required'
		]);

    	$comment = new Comment;
    	$post = Post::find($id);
    	$user = Auth::user();
    	$comment->comment = $request->input('comment');
    	$comment->user_id = $user->id;
    	$post->comments()->save($comment);
    	
    	return redirect()->back();
    }

    public function deleteComment($id)
    {
    	$comment = Comment::find($id);
    	$comment->delete();

    	return redirect()->back();
    }
}
