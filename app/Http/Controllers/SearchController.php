<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class SearchController extends Controller
{
    public function liveSearch(Request $request)
    {
    	if ($request->ajax())
    	{
    		$output = "";
        	$search = $request->get('search');
        	$searchedUsers = User::where('name', 'LIKE', "%$search%")->limit(5)->get();

        	if(count($searchedUsers) > 0)
        	{
        		foreach ($searchedUsers as $key => $searchedUser)
	        	{
	        		$output .= '<a href="../profile/'.$searchedUser->id.'" class="collection-item">
									<div class="row">
										<div class="col s2 m1 center-align">
											<img src="/uploads/profilepic/'.$searchedUser->profilepic.'" class="circle">
										</div>
										<div class="col s10 m11 profileBar">
											<span class="profileLink">'.$searchedUser->name.'</span>
										</div>
									</div>
								</a>';
	        	}
	        
	        	return response($output);
        	}

        	$output .= '<li class="collection-item noUsersDropdown">
        					<div class="center-align">
        						<h5 class="black-text">No users found!</h5>
        					</div>	
        				</li>';

        	return response($output);
    	}
    }
}
