<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AssignmentController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Assignment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $assignments = Assignment::with('user')->where('user_id', '=', $id)->latest()->paginate(5);

        return view('assignments.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new Assignment.
     *
     * @return Response
     */
    public function create()
    {
        return view('assignments.create');
    }

    /**
     * Store a newly created Assignment in storage.
     *
     * @param CreateAssignmentRequest $request
     *
     * @return Response
     */
    public function store(Assignment $assignment)
    {
        $assignment = Assignment::create($this->validateRequest());
        $this->User($assignment);

        return redirect(route('assignments.index'))->with('success','Assignment Created Successfully!');
    }

    /**
     * Display the specified Assignment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show(Assignment $assignment)
    {
        if (empty($assignment)) {
            return redirect(route('assignments.index'));
        }

        return view('assignments.show', compact('assignment'));
    }

    /**
     * Show the form for editing the specified Assignment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit(Assignment $assignment)
    {
        if(Auth::id() !== $assignment->user_id && Auth::user()->isAdmin !== 1){
            return redirect('/');
        }

        if (empty($assignment)) {
            return redirect(route('assignments.index'));
        }

        return view('assignments.edit', compact('assignment'));
    }

    /**
     * Update the specified Assignment in storage.
     *
     * @param int $id
     * @param UpdateAssignmentRequest $request
     *
     * @return Response
     */
    public function update(Assignment $assignment, Request $request)
    {
        if (empty($assignment)) {
            return redirect(route('assignments.index'));
        }

        $assignment->update($this->validateRequest());

        return redirect(route('assignments.index'))->with('success','Assignment Updated Successfully!');
    }

    /**
     * Remove the specified Assignment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Assignment $assignment)
    {
        if (empty($assignment)) {
            return redirect(route('assignments.index'));
        }

        $assignment->delete();

        return redirect(route('assignments.index'))->with('success','Assignment Deleted Successfully!');
    }

    private function validateRequest()
    {
        return request()->validate([
            'body' => 'required|min:4',

            'date' => 'sometimes',
            'isDone' => 'sometimes',
        ]);
    }

    private function User(Assignment $assignment)
    {
        $assignment->update([ 'user_id' => Auth::user()->id]);
    }
}
