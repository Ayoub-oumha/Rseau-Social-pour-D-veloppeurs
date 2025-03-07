<?php

namespace App\Http\Controllers;

use App\Models\language;
use App\Models\Post;

use Illuminate\Http\Request;
use App\Models\commenter;


class HomeController extends Controller
{
    public function index( Request $request)
    {
        
        $posts = Post::with("user")->orderBy('created_at', 'desc')->get();
        $user = $request->user() ;
        $userId = $user->id ;
        $language = new language() ;
        $languages = $language->where("user_id" , $userId)->get() ;
        $connections = $user->connections ;
        
        // $totalLikes = 0;
        // foreach ($posts as $post) {
        //     $totalLikes += $post->likes->count();
        // }
        // echo $totalLikes;
        // dd($posts->pluck('likes')) ;
        // dd($posts);
        return view('dashboard' , compact('posts' , 'user' , 'languages' , 'connections' , 'posts' ));
    }
}
