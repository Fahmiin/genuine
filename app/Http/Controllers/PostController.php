<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;
use App\Tag;
use App\Reply;
use App\Like;
use Auth;
use Image;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $request->validate(
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

    public function editPost(Request $request, $id)
    {
        $post = Post::find($id);
        $post->postDescription = $request->input('editPost');
        $request->user()->posts()->save($post);

        return back()->with('session_code', 'editSuccess');
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id', $id)->get();
        $likes = Like::where('post_id', $id)->get();
        
        foreach($comments as $comment)
        {
            $replies = Reply::where('comment_id', $comment->id)->get();

            foreach($replies as $reply)
            {
                $reply->delete();
            }

            $comment->delete();
        }

        foreach($likes as $like)
        {
            $like->delete();
        }

        $post->tags()->detach();
        $post->delete();

        return back()->with('session_code', 'deleteSuccess');
    }

    public function createLike(Request $request)
    {
        if ($request->ajax())
        {
            $post_id = $request->get('post_id');
            $post = Post::find($post_id);
            $user = Auth::user();
            $liked_post = Like::where('post_id', $post_id)
                                ->where('user_id', $user->id)
                                ->first();

            if($liked_post === null)
            {
                $newLike = new Like;
                $newLike->post_id = $post_id;
                $user->likes()->save($newLike);

                return response('like created!');
            }
            
            $liked_post->delete();

            return response('like delete!');
        }    
    }
}
