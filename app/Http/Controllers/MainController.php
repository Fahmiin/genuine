<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Auth;

class MainController extends Controller
{
	public function showPosts()
	{
		//PASS THESE DATA IF USER IS LOGGED IN
		if (Auth::check())
		{
			$user = Auth::user();
			$posts = Post::where("user_id", $user->id)->get();

			return view('main')
				->with('user', $user)
				->with('posts', $posts);
		}
		
		return view('main');
	}
}