<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

use App\Models\User;
use App\Models\Post;

class LikeNotification extends Notification
{
    use Queueable;

    // public $post;
    public $liker;

    // public function __construct(User $liker, Post $post)
    // public function __construct(Post $post)
    public function __construct($liker)

    {
        $this->liker = $liker->user->name;
        // $this->post = $post;
    }

    // Store the notification in the database
    public function toDatabase($notifiable)
    {
        return [
            'liker' => $this->liker,
            // 'post' => $this->post->title,
            'message' => $this->liker . ' liked your post',
        ];
    }

    // Broadcast the notification using Pusher
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'liker' => $this->liker,
            // 'title' => $this->post->title,
            'message' => $this->liker . ' liked your post',
        ]);
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }
}
