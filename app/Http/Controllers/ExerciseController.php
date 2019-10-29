<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use App\Models\Category;
use App\Models\Exercise;
use App\Repositories\ExerciseRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Storage;
use Response;
use Auth;

class ExerciseController extends AppBaseController
{
    /** @var  ExerciseRepository */
    private $exerciseRepository;

    public function __construct(ExerciseRepository $exerciseRepo)
    {
        $this->exerciseRepository = $exerciseRepo;
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
        $exercises = Exercise::with('category')->latest()->paginate(15);

        return view('exercises.index', compact('exercises'));
    }

    /**
     * Show the form for creating a new Exercise.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::get();

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
        $exercise = Exercise::create($this->validateRequest());

        $this->User($exercise);

        $img_request = $request->hasFile('pics');
        $img = $request->file('pics');
        $folder = 'exercise';
        $filenameToStore = $this->createImage($img_request, $img, $folder);
        $exercise->pics = $filenameToStore;

        $exercise->save();

        Flash::success('Exercise saved successfully.');

        return redirect(route('exercises.index'));
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
        if (empty($exercise)) {
            Flash::error('Exercise not found');

            return redirect(route('exercises.index'));
        }

        return view('exercises.show', compact('exercise'));
    }
    public function food()
    {
        $food = Exercise::where('category_id', '=', '6')->latest()->paginate(10);
        if (empty($food)) {
            Flash::error('Exercise not found');
            return redirect(route('exercises.index'));
        }
        return view('exercises.food', compact('food'));
    }
    public function cocktail()
    {
        $cocktail = Exercise::where('category_id', '=', '5')->latest()->paginate(10);
        if (empty($cocktail)) {
            Flash::error('Exercise not found');
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
        $categories = Category::get();

        if (empty($exercise)) {
            Flash::error('Exercise not found');

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
        $categories = Category::get();

        if (empty($exercise)) {
            Flash::error('Exercise not found');

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

        Flash::success('Exercise updated successfully.');

        return redirect(route('exercises.index', compact('categories')));
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
    public function destroy($id)
    {
        $exercise = $this->exerciseRepository->find($id);

        if (empty($exercise)) {
            Flash::error('Exercise not found');

            return redirect(route('exercises.index'));
        }

        $exercise->delete();
        if($exercise->pics != 'default.png'){
            // Delete Image
            Storage::delete('public/exercise/'.$exercise->pics);
        }

        Flash::success('Exercise deleted successfully.');

        return redirect(route('exercises.index'));
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
            //no pics $exercise->pics = $filenameToStore;
            'filenameToStore' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    private function User(Exercise $exercise)
    {
        $exercise->update([ 'user_id' => Auth::user()->id]);
    }
}
