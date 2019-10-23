<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('profiles.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
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
        if($request->hasFile('pics')){
            // Filename with extension
            $filenameWithExt = $request->file('pics')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('pics')->getClientOriginalExtension();
            // Filename to store
            $filenameToStor = $filename.'_'.time().'.'.$extension;
            //remove space if exist
            $filenameToStore = str_replace(' ','_', $filenameToStor);
            // Path to save file in albums folder
            $path = $request->file('pics')->storeAs('public/user', $filenameToStore);
        }
        if ($request->hasFile('pics')) {
            if ($user->pics != 'default.png') {
                // If Update Image Delete Old Image
                Storage::delete('public/user/' . $user->pics);
            };
            $user->pics = $filenameToStore;
        }

        $user->update($this->validateData());

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('home'));
        }

        return redirect('/profiles/'.$user->id);
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

    protected function validateData()
    {
        return request()->validate([
            'fullName' => 'required',
            'username' => 'required',
            'email' => 'required',

            'bio' => 'sometimes',
            //no pics $user->pics = $filenameToStore;
            'filenameToStore' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
    }
}

