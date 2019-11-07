<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Exercise;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'food', 'cocktail');
    }
    /**
     * Display a listing of the Exercise.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Exercise $exercise)
    {
        $id = Auth::id();
        $exercises = Exercise::with('category')->where('user_id', '=', $id)->latest()->paginate(15);

        return view('exercises.index', compact('exercises'));
    }

    /**
     * Show the form for creating a new Exercise.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::where('subCategory', '=', '2')->get();

        return view('exercises.create', compact('categories'));
    }

    /**
     * Store a newly created Exercise in storage.
     *
     * @param CreateExerciseRequest $request
     *
     * @return Response
     */
    public function store(Request $request, User $user, Exercise $exercise)
    {
        $tags = explode(',', $request->exercise_tag);
        $exercise = Exercise::create($this->validateRequest());

        $this->User($exercise);

        $img_request = $request->hasFile('pics');
        $img = $request->file('pics');
        $folder = 'exercise';
        $filenameToStore = $this->createImage($img_request, $img, $folder);
        $exercise->pics = $filenameToStore;

        $exercise->tag($tags);

        $exercise->save();

        return redirect(route('exercises.index'))->with('success','Exercise Created Successfully!');
    }

    /**
     * Display the specified Exercise.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show(Exercise $exercise)
    {
        $fav = $exercise->isFavorited(); // returns a boolean with true or false.

        if (empty($exercise)) {
            return redirect(route('exercises.index'));
        }

        return view('exercises.show', compact('exercise', 'fav'));
    }
    public function food()
    {
        $food = Exercise::where('category_id', '=', '6')->latest()->paginate(10);
        if (empty($food)) {
            return redirect(route('exercises.index'));
        }
        return view('exercises.food', compact('food'));
    }
    public function cocktail()
    {
        $cocktail = Exercise::where('category_id', '=', '5')->latest()->paginate(10);
        if (empty($cocktail)) {
            return redirect(route('exercises.index'));
        }
        return view('exercises.cocktail', compact('cocktail'));
    }

    /**
     * Show the form for editing the specified Exercise.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit(Exercise $exercise)
    {
        if(Auth::id() !== $exercise->user_id && Auth::user()->isAdmin !== 1){
            return redirect('/');
        }

        $categories = Category::where('subCategory', '=', '2')->get();

        if (empty($exercise)) {
            return redirect(route('exercises.index'));
        }

        return view('exercises.edit', compact('exercise', 'categories'));
    }

    /**
     * Update the specified Exercise in storage.
     *
     * @param int $id
     * @param UpdateExerciseRequest $request
     *
     * @return Response
     */
    public function update(Request $request, Exercise $exercise, User $user)
    {
        $tags = explode(',', $request->exercise_tag);
        $categories = Category::get();

        if (empty($exercise)) {
            return redirect(route('exercises.index'));
        }


        $this->User($exercise);

        $folder = 'exercise';
        $img_request = $request->hasFile('pics');

        if(Request()->hasFile('pics')){
            $img = Request()->file('pics');
            if($exercise->pics != 'default.png'){
                // Delete Image
                Storage::delete('public/exercise/'. $folder .'/'.$exercise->pics);
            }
            $filenameToStore = $this->updateImage($img_request, $img, $folder);
            $exercise->pics = $filenameToStore;
        }

        $exercise->update($this->validateRequest());

        $exercise->retag($tags);

        return redirect(route('exercises.index', compact('categories')))->with('success','Exercise Updated Successfully!');
    }

    /**
     * Remove the specified Exercise from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Exercise $exercise)
    {
        if (empty($exercise)) {
            return redirect(route('exercises.index'));
        }

        $exercise->delete();
        if($exercise->pics != 'default.png'){
            // Delete Image
            Storage::delete('public/exercise/'.$exercise->pics);
        }

        return redirect(route('exercises.index'))->with('success','Exercise Deleted Successfully!');
    }

    private function validateRequest()
    {
        return request()->validate([
            'title' => 'required|min:4',
            'ingredients' => 'required',
            'make' => 'required',

            'user_id' => 'sometimes',
            'category_id' => 'sometimes',
            'fromMin' => 'sometimes',
            'video' => 'sometimes',
            'tag' => 'sometimes',
            //no pics $exercise->pics = $filenameToStore;
            'filenameToStore' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    private function User(Exercise $exercise)
    {
        $exercise->update([ 'user_id' => Auth::user()->id]);
    }
}
