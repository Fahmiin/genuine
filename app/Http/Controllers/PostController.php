<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;
use App\Tag;
use Auth;
use Image;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $this->validate($request,
        [
            'postPic' => 'required',
            'postDescription' => 'required',
            'tags' => 'required'
        ]);

        $postPic = $request->file('postPic');
        $filename = time().'.'.$postPic->getClientOriginalExtension();
        Image::make($postPic)->resize(475, 400)->save(public_path('/uploads/postPic/'.$filename));

        $post = new Post;
        $post->postPic = $filename;
        $post->postDescription = $request->input('postDescription');
        $request->user()->posts()->save($post);

        $post->tags()->attach($request->tags);

        return back()->with('session_code', 'postSuccess');
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id', $id);
        $post->tags()->detach();
        $post->delete();
        $comments->delete();

        return back()->with('session_code', 'deleteSuccess');
    }
}
