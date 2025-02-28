<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\language;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;



class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function updateCover(Request $request)
        {
         
            
            $request->validate([
                'cover_image' => ['required'],
            ]);

            $user = User::find(Auth::id()); // Ensure $user is an instance of User model

            $imagepath = $request->file('cover_image') ? $request->file('cover_image')->store('cover_image', 'public') : null;
       
            // Update user's cover image path in the database
            $user->cover_image = $imagepath;
            $user->save();

            return redirect()->route('profile.edit')->with('status', 'Cover image updated successfully!');
        }
        public function updateImage(Request $request)
        {
            $request->validate([
                'profile_image' => ['required'],
            ]);

            $user = User::find(Auth::id()); // Ensure $user is an instance of User model

            $imagepath = $request->file('profile_image') ? $request->file('profile_image')->store('profile_image', 'public') : null;
       
            // Update user's profile image path in the database
            $user->profile_image = $imagepath;
            $user->save();

            return redirect()->route('profile.edit')->with('status', 'Profile image updated successfully!');
        }
        public function addLanguage(Request $request){
            $userId = Auth::id();
            $request->validate([
                'skill' => ['required'],
            ]);
           
            // language::create([
            //     'user_id' => $userId,
            //     'name' => $request->skill,
            // ]);
            $user = User::find(Auth::id()); 
            $user->languages()->create(['name' =>  $request->skill]);
            
            return  redirect()->route('profile.edit')->with('status', 'Language added successfully!');
        }
        public function addProject(Request $request){
            // $userId = Auth::id();
            // dd($request->all());
            $info = $request->validate([
                'title' => ['required'],
                'project_url' => ['required'],
                'github_url' => ['required'],
            ]);
            $user = User::find(Auth::id()); 
            $user->projects()->create($info);
        }
}
