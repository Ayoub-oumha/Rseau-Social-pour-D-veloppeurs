<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class likes extends Controller
{
    public function like(Post $post)
    {
        $user = Auth::user();

        // Check if user already liked the post
        if ($post->isLikedByUser($user->id)) {
            return response()->json(['message' => 'Already liked'], 400);
        }

        $post->likes()->create(['user_id' => $user->id]);

        return response()->json(['message' => 'Liked successfully']);
    }

    public function unlike(Post $post)
    {
        $user = Auth::user();

        // Remove like if exists
        $post->likes()->where('user_id', $user->id)->delete();

        return response()->json(['message' => 'Unliked successfully']);
    }
}
