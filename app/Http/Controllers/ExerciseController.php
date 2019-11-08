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
    //auth user create update delete
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'food', 'cocktail');
    }

    public function index(Exercise $exercise)
    {
        //get auth user id
        $id = Auth::id();
        //get latest exercise for auth user paginate 15 and send to index
        $exercises = Exercise::where('user_id', '=', $id)->latest()->paginate(15);
        return view('exercises.index', compact('exercises'));
    }

    public function create()
    {
        //send categories with subCategory 2 to func store
        $categories = Category::where('subCategory', '=', '2')->get();
        return view('exercises.create', compact('categories'));
    }

    public function store(Request $request, User $user, Exercise $exercise)
    {
        //explode tags by ,
        $tags = explode(',', $request->exercise_tag);
        //validate data and create without user and pics
        $exercise = Exercise::create($this->validateRequest());
        //add auth user
        $this->User($exercise);
        //add pics
        $img_request = $request->hasFile('pics');
        $img = $request->file('pics');
        $folder = 'exercise';
        $filenameToStore = $this->createImage($img_request, $img, $folder);
        $exercise->pics = $filenameToStore;
        //add tags
        $exercise->tag($tags);
        //save exercise
        $exercise->save();
        return redirect(route('exercises.index'))->with('success','Exercise Created Successfully!');
    }

    public function show(Exercise $exercise)
    {
        // returns a boolean with true or false
        $fav = $exercise->isFavorited();
        if (empty($exercise)) {
            return redirect(route('exercises.index'));
        }
        return view('exercises.show', compact('exercise', 'fav'));
    }

    public function food()
    {
        //get exercise where category id
        $food = Exercise::where('category_id', '=', '6')->latest()->paginate(10);
        if (empty($food)) {
            return redirect(route('exercises.index'));
        }
        return view('exercises.food', compact('food'));
    }

    public function cocktail()
    {
        //get exercise where category id
        $cocktail = Exercise::where('category_id', '=', '5')->latest()->paginate(10);
        if (empty($cocktail)) {
            return redirect(route('exercises.index'));
        }
        return view('exercises.cocktail', compact('cocktail'));
    }

    public function edit(Exercise $exercise)
    {
        //check for exercise user and if is admin
        if(Auth::id() !== $exercise->user_id && Auth::user()->isAdmin !== 1){
            return redirect('/');
        }
        //get categories with subCategory send to update
        $categories = Category::where('subCategory', '=', '2')->get();
        if (empty($exercise)) {
            return redirect(route('exercises.index'));
        }
        return view('exercises.edit', compact('exercise', 'categories'));
    }

    public function update(Request $request, Exercise $exercise, User $user)
    {
        //explode tags by ,
        $tags = explode(',', $request->exercise_tag);
        //get categories send from edit
        $categories = Category::get();
        if (empty($exercise)) {
            return redirect(route('exercises.index'));
        }
        //save auth user
        $this->User($exercise);
        //save picture
        $folder = 'exercise';
        $img_request = $request->hasFile('pics');
        //check for picture
        if(Request()->hasFile('pics')){
            $img = Request()->file('pics');
            if($exercise->pics != 'default.png'){
                // Delete Image
                Storage::delete('public/exercise/'. $folder .'/'.$exercise->pics);
            }
            $filenameToStore = $this->updateImage($img_request, $img, $folder);
            $exercise->pics = $filenameToStore;
        }
        //update exercise
        $exercise->update($this->validateRequest());
        //retag
        $exercise->retag($tags);
        return redirect(route('exercises.index', compact('categories')))->with('success','Exercise Updated Successfully!');
    }

    public function destroy(Exercise $exercise)
    {
        if (empty($exercise)) {
            return redirect(route('exercises.index'));
        }
        //delete exercise
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
            'category_id' => 'required',

            'user_id' => 'sometimes',
            'fromMin' => 'sometimes',
            'video' => 'sometimes',
            'tag' => 'sometimes',
            //no pics $exercise->pics = $filenameToStore;
            'filenameToStore' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    //func get auth user to save user_id
    private function User(Exercise $exercise)
    {
        $exercise->update([ 'user_id' => Auth::user()->id]);
    }
}
