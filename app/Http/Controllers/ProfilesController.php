<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Exercise;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ProfilesController extends AppBaseController
{
    public function __construct()
    {
        //auth user update delete
        $this->middleware('auth')->except('show');
    }

    public function show(User $user)
    {
        // returns a collection with the Blog the User marked as favorite
        $blogs = $user->favorite(Blog::class);
        // returns a collection with the Exercise the User marked as favorite
        $exercises = $user->favorite(Exercise::class);
        return view('profiles.show', compact('user', 'blogs', 'exercises'));
    }

    public function edit(User $user)
    {
        //check if is user or admin
        if(Auth::id() !== $user->id && Auth::user()->isAdmin !== 1){
            return redirect('/');
        }
        return view('profiles.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (empty($user)) {
            return redirect(route('home'));
        }
        //save picture
        $folder = 'user';
        $img_request = $request->hasFile('pics');
        //check picture
        if(Request()->hasFile('pics')){
            $img = Request()->file('pics');
            if($user->pics != 'default.png'){
                // Delete Image
                Storage::delete('public/'. $folder .'/'.$user->pics);
            }
            $filenameToStore = $this->updateImage($img_request, $img, $folder);
            $user->pics = $filenameToStore;
        }
        //update user
        $user->update($this->validateRequest());
        return redirect('/profiles/'.$user->id)->with('success','User Updated Successfully!');
    }

    public function destroy(User $user)
    {
        if (empty($user)) {
            return redirect(route('welcome'));
        }
        //delete user
        $user->delete();
        if($user->pics != 'default.png'){
            // Delete Image
            Storage::delete('public/user/'.$user->pics);
        }
        return redirect(route('welcome'))->with('success','User Deleted Successfully!');
    }

    protected function validateRequest()
    {
        return request()->validate([
            'fullName' => 'required',
            'username' => 'required',
            'email' => 'required|email',

            'bio' => 'sometimes',
            //no pics $user->pics = $filenameToStore;
            'filenameToStore' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:48',
        ]);
    }
}

