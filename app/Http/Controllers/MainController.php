<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
use Auth;

class MainController extends Controller
{
	public function showPosts()
	{
		if (Auth::check())
		{
			$user = Auth::user();
			$posts = Post::all();
			$comments = Comment::all();

			return view('main')
				->with('user', $user)
				->with('posts', $posts)
				->with('comments', $comments);
		}
		
		$user = User::all();
		$posts = Post::all();
		$comments = Comment::all();
		
		return view('main')
			->with('user', $user)
			->with('posts', $posts)
			->with('comments', $comments);
	}


	//COMMENT Controller
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
    	
    	return redirect()->route('showPosts');
    }

    public function deleteComment($id)
    {
    	$comment = Comment::find($id);
    	$comment->delete();

    	return redirect()->route('showPosts');
    }
}