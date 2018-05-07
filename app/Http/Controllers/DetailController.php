<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Detail;
use Auth;
use App\User;

class DetailController extends Controller
{
	public function updateAbout(Request $request, $id)
	{
		//find the current detail $id and update only
		$detail = Detail::find($id);
		$detail->about = $request->input('about');
		//Connect from user to detail table
		$request->user()->detail()->save($detail);

		$user = Auth::user();
		$detail = Detail::all();

		return view('profile')->with('detail', $detail)->with('user', $user);
	}

	public function updateEducation(Request $request, $id)
	{
		//find the current detail $id and update only
		$detail = Detail::find($id);
		$detail->education = $request->input('education');
		//Connect from user to detail table
		$request->user()->detail()->save($detail);

		$user = Auth::user();
		$detail = Detail::all();

		return view('profile')->with('detail', $detail)->with('user', $user);
	}

	public function updateWork(Request $request, $id)
	{
		//find the current detail $id and update only
		$detail = Detail::find($id);
		$detail->work = $request->input('work');
		//Connect from user to detail table
		$request->user()->detail()->save($detail);

		$user = Auth::user();
		$detail = Detail::all();

		return view('profile')->with('detail', $detail)->with('user', $user);
	}
}