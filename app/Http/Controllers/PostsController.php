<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;


class PostsController extends Controller
{
    public function store(Request $request){
        $data = request()->validate([
            'content' => 'required',
            'tags' => 'required',
            'code' => '',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('posts', 'public');
        $user = $request->user() ;
        $userId = $user->id ;
        $tagsArray = explode(' ', $data['tags']);
        $tags = json_encode($tagsArray);
        // echo $tags;
        // dd($tags);
        Post::create([
            'content' => $data['content'],
            'tags' => $tags,
            'code' => $data['code'],
            'image' => $imagePath,
            'user_id' => $userId,
        ]);

            
        // return redirect('/profile/' . $userId);
        return  redirect()->route('dashboard') ;

        

    }
}
