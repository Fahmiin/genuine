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
}