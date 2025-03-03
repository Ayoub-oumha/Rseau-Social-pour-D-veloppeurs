<?php

use App\Http\Controllers\CommenterController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

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
    Route::post('/posts/store', [PostsController::class, 'store'])->name('posts.store');

   
});
Route::middleware(['auth'])->group(function () {
    Route::post('/commontes/store', [CommenterController::class, 'store'])->name('comments.store');

   
});
Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
   
});

require __DIR__.'/auth.php';
