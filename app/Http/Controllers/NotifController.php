<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotifController extends Controller
{
    public function mark()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return back()->with('session_code', 'mark');
    }

    public function markType($id)
    {
    	$user = Auth::user();
    	$user->unreadNotifications->find($id)->markAsRead();

        return back();
    }
}
