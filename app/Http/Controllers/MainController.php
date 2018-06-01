<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class MainController extends Controller
{
	public function showPosts()
	{
		$posts = Post::paginate(20);
		
		return view('main')->with('posts', $posts);
	}
}