<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
    	if (Auth::check())
    	{
    		$user = Auth::user();
	        $search = $request->get('search');
	        $searchedUsers = User::where('name', 'LIKE', "%$search%")->get();

	        return view('search')
	        	->with('user', $user)
	        	->with('searchedUsers', $searchedUsers);
    	}

        $search = $request->get('search');
        $searchedUsers = User::where('name', 'LIKE', "%$search%")->get();

        return view('search')
        	->with('searchedUsers', $searchedUsers);
    }   

}
