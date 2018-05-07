<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use Auth;
use Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        $products = Product::where("user_id", $user->id)->get();

        return view('profile')->with('user',$user)->with('products', $products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    public function update(Request $request, $id)
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
}
