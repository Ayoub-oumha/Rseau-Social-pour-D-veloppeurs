<?php

namespace App\Http\Controllers;

use App\Models\commenter;
use Illuminate\Http\Request;


class CommenterController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'comment' => 'required'
        ]);
        
        $comment = new Commenter();
        $comment->comment = $request->comment;
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $request->post_id;
        $comment->save();
        return back();

    }
}
