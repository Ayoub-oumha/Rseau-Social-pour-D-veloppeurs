<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnectionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

   
        $pandingRequests = $user->pendingRequests;
        $friends = $user->friendships;

        $followers = $user->followers->unique('id');
        $following = $user->following->unique('id');
        $connections = $followers->concat($following);
        // $otherusers = User::where('id', '!=', )->get();
        
        
        dd($otherusers);
       
        return view('friends.allfriends' , compact('connections' , 'pandingRequests', 'followers', 'following'));
        // return view('friends.allfriends', compact('connections', 'pendingRequests', 'suggestions', 'stats'));
    }

    public function sendRequest($userId)
    {
    }

    public function acceptRequest($userId)
    {  
    }

    public function ignoreRequest($userId)
    {    
    }

    public function removeConnection($userId)
    {
    }
}

