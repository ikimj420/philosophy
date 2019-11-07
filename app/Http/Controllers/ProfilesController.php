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
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $blogs = $user->favorite(Blog::class); // returns a collection with the Blog the User marked as favorite
        $exercises = $user->favorite(Exercise::class); // returns a collection with the Exercise the User marked as favorite

        return view('profiles.show', compact('user', 'blogs', 'exercises'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Auth::id() !== $user->user_id && Auth::user()->isAdmin !== 1){
            return redirect('/');
        }

        return view('profiles.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (empty($user)) {
            return redirect(route('home'));
        }
        $folder = 'user';
        $img_request = $request->hasFile('pics');

        if(Request()->hasFile('pics')){
            $img = Request()->file('pics');
            if($user->pics != 'default.png'){
                // Delete Image
                Storage::delete('public/'. $folder .'/'.$user->pics);
            }
            $filenameToStore = $this->updateImage($img_request, $img, $folder);
            $user->pics = $filenameToStore;
        }

        $user->update($this->validateRequest());

        return redirect('/profiles/'.$user->id)->with('success','User Updated Successfully!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
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

