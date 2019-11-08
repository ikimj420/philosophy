<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AssignmentController extends AppBaseController
{
    //only for auth user
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //get auth user id
        $id = Auth::user()->id;
        //get latest assignment for auth user paginate 10 and send to index
        $assignments = Assignment::where('user_id', '=', $id)->latest()->paginate(10);

        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        return view('assignments.create');
    }

    public function store(Assignment $assignment)
    {
        //validate
        $assignment = Assignment::create($this->validateRequest());
        //save
        $this->User($assignment);
        return redirect(route('assignments.index'))->with('success','Assignment Created Successfully!');
    }

    public function show(Assignment $assignment)
    {
        if (empty($assignment)) {
            return redirect(route('assignments.index'));
        }
        return view('assignments.show', compact('assignment'));
    }

    public function edit(Assignment $assignment)
    {
        //check for auth user or admin
        if(Auth::id() !== $assignment->user_id && Auth::user()->isAdmin !== 1){
            return redirect('/');
        }
        if (empty($assignment)) {
            return redirect(route('assignments.index'));
        }
        return view('assignments.edit', compact('assignment'));
    }

    public function update(Assignment $assignment, Request $request)
    {
        if (empty($assignment)) {
            return redirect(route('assignments.index'));
        }
        //validate and update
        $assignment->update($this->validateRequest());
        return redirect(route('assignments.index'))->with('success','Assignment Updated Successfully!');
    }

    public function done($assignment)
    {
        $assignment = Assignment::findOrFail($assignment);
        //dd($assignment);
        if (empty($assignment)) {
            return redirect(route('assignments.index'));
        }
        //update isDone
        $assignment->isDone = true;
        $assignment->save();
        return redirect(route('assignments.index'))->with('success','Assignment Done!');
    }

    public function destroy(Assignment $assignment)
    {
        if (empty($assignment)) {
            return redirect(route('assignments.index'));
        }
        //delete
        $assignment->delete();
        return redirect(route('assignments.index'))->with('success','Assignment Deleted Successfully!');
    }

    //func validate
    private function validateRequest()
    {
        return request()->validate([
            'body' => 'required|min:4',

            'date' => 'sometimes',
            'isDone' => 'sometimes',
        ]);
    }

    //func get auth user to save user_id
    private function User(Assignment $assignment)
    {
        $assignment->update([ 'user_id' => Auth::user()->id]);
    }
}
