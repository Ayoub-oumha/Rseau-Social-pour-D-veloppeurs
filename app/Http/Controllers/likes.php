<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\EventLikeNotification;

class likes extends Controller
{
    // public function like(Post $post)
    // {
    //     $user = Auth::user();

    //     // Check if user already liked the post
    //     if ($post->isLikedByUser($user->id)) {
    //         return response()->json(['message' => 'Already liked'], 400);
    //     }

    //     $post->likes()->create(['user_id' => $user->id]);

    //     return response()->json(['message' => 'Liked successfully']);
    // }

    // public function unlike(Post $post)
    // {
    //     $user = Auth::user();

    //     // Remove like if exists
    //     $post->likes()->where('user_id', $user->id)->delete();

    //     return response()->json(['message' => 'Unliked successfully']);
    // }


    public function toggleLike(Post $post)
    {
        $like = $post->likes()->where('user_id', auth()->id())->first();

        if ($like) {
            $like->delete();
            $isLiked = false;
        } else {
            if ($post->user_id !== auth()->id()) {
                event(new EventLikeNotification([
                    'liker' => auth()->user()->name,
                    'message' => auth()->user()->name . ' liked your post',
                ]));
            }
            $post->likes()->create([
                'user_id' => auth()->id()
            ]);
            $isLiked = true;
        }


        return response()->json([
            'success' => true,
            'likesCount' => $post->likes()->count(),
            'isLiked' => $isLiked
        ]);
    }

    public function checkLike(Post $post)
    {
        return response()->json([
            'isLiked' => $post->likes()->where('user_id', auth()->id())->exists()
        ]);
    }
}
