<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Comment;
use Auth;

class TagController extends Controller
{
	public function showTags()
	{
        $tags = Tag::all();

        return view('tag')->with('tags', $tags);
	}

	public function showTag($id)
	{
		$tag = Tag::find($id);

		return view('tag_id')->with('tag', $tag);
	}

    public function createTag(Request $request)
    {

    	$request->validate(['tag' => 'required|max:20']);

    	$tag = new Tag;
    	$tag->tag = $request->input('tag');
    	$tag->save();

    	return back()->with('session_code', 'tagCreateSuccess');
    }

    public function searchTags(Request $request)
    {
    	if ($request->ajax())
    	{
    		$output = "";
    		$search = $request->get('search');
    		$searchedTags = Tag::where('tag', 'LIKE', "%$search%")->limit(10)->get();

    		if (count($searchedTags) > 0)
    		{
    			foreach($searchedTags as $key => $searchedTag)
    			{
    				$output .= '<a href="/tag/'.$searchedTag->id.'" class="collection-item">'.$searchedTag->tag.'</a>';
    			}

    			return response($output);
    		}

    		$output .= '<div class="center-align">
    						<h5>No Tags found!</h5>
    					</div>';

    		return response($output);			
    	}
    }
}
