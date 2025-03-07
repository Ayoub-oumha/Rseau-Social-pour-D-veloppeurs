<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class message extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // $pandingRequests = $user->pendingRequests;
        // $friends = $user->friendships;

        $followers = $user->followers;
        $following = $user->following;
        $connections = $followers->concat($following);
        // dd($connections);
        return view('messages.messages' , compact('connections'));
    }
}
