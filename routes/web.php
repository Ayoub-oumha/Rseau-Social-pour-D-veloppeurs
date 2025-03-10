<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommenterController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\likes;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Message;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'display'])->name('profile.display');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/profile/cover', [ProfileController::class, 'updateCover'])->name('profile.cover');
    Route::patch('/profile/profile_image', [ProfileController::class, 'updateImage'])->name('profile.image.update');
    Route::post('/profile/addLanguage', [ProfileController::class, 'addLanguage'])->name('add.langue');
    Route::post('/profile/addProject', [ProfileController::class, 'addProject'])->name('add.project');

});
Route::middleware(['auth'])->group(function () {
    Route::get('/connections', [ConnectionController::class, 'index'])->name('connections.index');
    Route::post('/connections/{user}', [ConnectionController::class, 'sendRequest'])->name('connections.send');
    Route::post('/connections/accept/{user}', [ConnectionController::class, 'acceptRequest'])->name('connections.accept');
    Route::post('/connections/{user}/ignore', [ConnectionController::class, 'ignoreRequest'])->name('connections.ignore');
    Route::delete('/connections/{user}', [ConnectionController::class, 'removeConnection'])->name('connections.remove');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/message', [Message::class, 'index'])->name('message.index');
});
Route::middleware('auth')->group(function () {
   
    Route::post('/posts/{post}/like', [likes::class, 'toggleLike'])->name('posts.like');
    Route::get('/posts/{post}/check-like', [likes::class, 'checkLike'])->name('posts.checkLike');

});
Route::middleware(['auth'])->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/conversations', [ChatController::class, 'getConversations'])->name('chat.conversations');
    Route::get('/chat/messages/{userId}', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/messages', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/unread', [ChatController::class, 'getUnreadCount'])->name('chat.unread');
    Route::post('/chat/messages/{messageId}/read', [ChatController::class, 'markAsRead'])->name('chat.read');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', function (){
        
        return view('notifications.notifications');
    })->name('notifications');
   
});
Route::get('/notifications/all', function() {
    return view('notifications.index', [
        'notifications' => auth()->user()->notifications()->paginate(10)
    ]);
})->middleware(['auth'])->name('notifications');

Route::post('/notifications/{id}/mark-as-read', function($id) {
    auth()->user()->notifications()->findOrFail($id)->markAsRead();
    return back();
})->middleware(['auth'])->name('notifications.markAsRead');




Route::middleware(['auth'])->group(function () {
    Route::post('/posts/store', [PostsController::class, 'store'])->name('posts.store');
});
Route::middleware(['auth'])->group(function () {
    Route::post('/commontes/store', [CommenterController::class, 'store'])->name('comments.store');

   
});
Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
   
});

Route::get('/tweet', [TweetController::class, 'create'])->name('tweets.create');
Route::post('/tweets', [TweetController::class, 'store'])->name('tweets.store');
Route::view('pusher1', 'pusher1');
Route::view('pusher2', 'pusher2');


require __DIR__.'/auth.php';
