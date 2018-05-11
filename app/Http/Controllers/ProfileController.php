<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Detail;
use App\Product;
use App\Post;
use Auth;
use Image;

class ProfileController extends Controller
{
    //SHOW ALL INFO OF PROFILE PAGE
    public function show()
    {
        //PASS THESE DATA IF USER IS LOGGED IN
        if (Auth::check())
        {
            $user = Auth::user();
            $userP = Auth::user();
            $detail = Detail::all();
            $products = Product::where("user_id", $userP->id)->get();
            $posts = Post::where("user_id", $userP->id)->get();

            return view('profile')
                ->with('user', $user)
                ->with('userP',$userP)
                ->with('detail', $detail)
                ->with('products', $products)
                ->with('posts', $posts);
        }
    }


    //SHOW ALL DATA WHEN GUEST VISITS
    public function showLoggedout($id)
    {
        $user = Auth::user();
        $userP = User::find($id);
        $detail = Detail::find($id);
        $products = Product::where("user_id", $userP->id)->get();
        $posts = Post::where("user_id", $userP->id)->get();

        return view('profile')
            ->with('user', $user)
            ->with('userP', $userP)
            ->with('detail', $detail)
            ->with('products', $products)
            ->with('posts', $posts);
    }


    //PROFILE CONTROLLER
    public function updateProfilepic(Request $request, $id)
    {
        if ($request->hasFile('profilepic'))
        {
            $profilePic = $request->file('profilepic');
            $filename = time().'.'.$profilePic->getClientOriginalExtension();
            Image::make($profilePic)->resize(300, 300)->save(public_path('/uploads/profilepic/'.$filename));

            $user = Auth::user();
            $user->profilepic = $filename;
            $user->save();

            return redirect()->route('profilePage');
        } 
    }

    public function updateProfile(Request $request, $id)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->tagline = $request->input('tagline');
        $user->mobile = $request->input('mobile');
        $user->website = $request->input('website');
        $user->contact_email = $request->input('contact_email');
        $user->save();

        return redirect()->route('profilePage');
    }


    //DETAILS CONTROLLER
    public function updateAbout(Request $request, $id)
    {
        $detail = Detail::find($id);
        $detail->about = $request->input('about');
        $request->user()->detail()->save($detail);

        return redirect()->route('profilePage');
    }

    public function updateEducation(Request $request, $id)
    {
        $detail = Detail::find($id);
        $detail->education = $request->input('education');
        $request->user()->detail()->save($detail);

        return redirect()->route('profilePage');
    }

    public function updateWork(Request $request, $id)
    {
        $detail = Detail::find($id);
        $detail->work = $request->input('work');
        $request->user()->detail()->save($detail);

        return redirect()->route('profilePage');
    }


    //PRODUCTS CONTROLLER
    public function createProduct(Request $request)
    {
        $product = new Product;
        $product->productTitle = $request->input('productTitle');
        $product->productDescription = $request->input('productDescription');
        $product->productPricing = $request->input('productPricing');
        $request->user()->products()->save($product);

        return redirect()->route('profilePage');
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('profilePage');
    }


    //POSTS CONTROLLER
    public function createPost(Request $request)
    {
        $postPic = $request->file('postPic');
        $filename = time().'.'.$postPic->getClientOriginalExtension();
        Image::make($postPic)->resize(375, 300)->save(public_path('/uploads/postPic/'.$filename));

        $post = new Post;
        $post->postPic = $filename;
        $post->postDescription = $request->input('postDescription');
        $request->user()->posts()->save($post);

        return redirect()->route('profilePage');
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('profilePage');
    }
}
