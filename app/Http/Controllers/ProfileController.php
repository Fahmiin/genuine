<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Detail;
use App\Product;
use App\Post;
use App\Comment;
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
            $user = $userP = Auth::user();
            $detail = Detail::all();
            $products = Product::where("user_id", $userP->id)->get();
            $posts = Post::where("user_id", $userP->id)->get();
            $comments = Comment::all();

            return view('profile')
                ->with('user', $user)
                ->with('userP',$userP)
                ->with('detail', $detail)
                ->with('products', $products)
                ->with('posts', $posts)
                ->with('comments', $comments);
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
        $comments = Comment::all();

        return view('profile')
            ->with('user', $user)
            ->with('userP', $userP)
            ->with('detail', $detail)
            ->with('products', $products)
            ->with('posts', $posts)
            ->with('comments', $comments);
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
        $this->validate(request(),
        [
            'name' => 'required|max:10',
            'tagline' => 'required',
            'mobile' => 'required|integer|max:11',
            'website' => 'required|max:20',
            'contact_email' => 'required|email|max:20'
        ]);

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
        $this->validate(request(),
        [
            'productTitle' => 'required|max:30',
            'productDescription' => 'required',
            'productPricing' => 'required|max:30'
        ]);

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
}
