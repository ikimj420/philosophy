<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Category.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(User $user)
    {
        if(!Auth::user()->isAdmin){
            return redirect('/');
        }

        $categories = Category::latest()->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create()
    {
        if(!Auth::user()->isAdmin){
            return redirect('/')->with('error', 'No No No!!!');
        }

        return view('categories.create');
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function store(Request $request, Category $category)
    {
        if(!Auth::user()->isAdmin){
            return redirect('/');
        }

        $category = Category::create($this->validateRequest());

        $img_request = $request->hasFile('pics');
        $img = $request->file('pics');
        $folder = 'category';
        $filenameToStore = $this->createImage($img_request, $img, $folder);
        $category->pics = $filenameToStore;

        $category->save();

        return redirect(route('categories.index'))->with('success','Category Created Successfully!');
    }

    /**
     * Display the specified Category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show(Category $category)
    {
        if(!Auth::user()->isAdmin){
            return redirect('/');
        }

        if (empty($category)) {
            return redirect(route('categories.index'));
        }

        return view('categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit(Category $category)
    {
        if(!Auth::user()->isAdmin){
            return redirect('/');
        }

        if (empty($category)) {
            return redirect(route('categories.index'));
        }

        return view('categories.edit')->with('category', $category);
    }

    /**
     * Update the specified Category in storage.
     *
     * @param int $id
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    public function update(Request $request, Category $category)
    {
        if(!Auth::user()->isAdmin){
            return redirect('/');
        }

        if (empty($category)) {
            Flash::error('Category not found');
            return redirect(route('categories.index'));
        }

        $folder = 'category';
        $img_request = $request->hasFile('pics');

        if(Request()->hasFile('pics')){
            $img = Request()->file('pics');
            if($category->pics != 'default.png'){
                // Delete Image
                Storage::delete('public/'. $folder .'/'.$category->pics);
            }
            $filenameToStore = $this->updateImage($img_request, $img, $folder);
            $category->pics = $filenameToStore;
        }

        $category->update($this->validateRequest());

        return redirect(route('categories.index'))->with('success','Category Updated Successfully!');
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Category $category)
    {
        if (empty($category)) {
            return redirect(route('categories.index'));
        }
        $category->delete();
        if($category->pics != 'default.png'){
            // Delete Image
            Storage::delete('public/category/'.$category->pics);
        }

        return redirect(route('categories.index'))->with('success','Category Deleted Successfully!');
    }

    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required|min:4',
            'subCategory' => 'required',
            'desc' => 'sometimes',

            //no pics $category->pics = $filenameToStore;
            'filenameToStore' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }
}
