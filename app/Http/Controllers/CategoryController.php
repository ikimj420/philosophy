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
    //only for auth user
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        //check if is admin
        if(!Auth::user()->isAdmin){
            return redirect('/');
        }
        //get all latest categories
        $categories = Category::latest()->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        //check if is admin
        if(!Auth::user()->isAdmin){
            return redirect('/');
        }
        return view('categories.create');
    }

    public function store(Request $request, Category $category)
    {
        //check if is admin
        if(!Auth::user()->isAdmin){
            return redirect('/');
        }
        //validate ahd create without picture
        $category = Category::create($this->validateRequest());
        //add picture
        $img_request = $request->hasFile('pics');
        $img = $request->file('pics');
        $folder = 'category';
        $filenameToStore = $this->createImage($img_request, $img, $folder);
        $category->pics = $filenameToStore;
        //save category
        $category->save();
        return redirect(route('categories.index'))->with('success','Category Created Successfully!');
    }

    public function show(Category $category)
    {
        //check if is admin
        if(!Auth::user()->isAdmin){
            return redirect('/');
        }
        if (empty($category)) {
            return redirect(route('categories.index'));
        }
        return view('categories.show')->with('category', $category);
    }

    public function edit(Category $category)
    {
        //check if is admin
        if(!Auth::user()->isAdmin){
            return redirect('/');
        }
        if (empty($category)) {
            return redirect(route('categories.index'));
        }
        return view('categories.edit')->with('category', $category);
    }

    public function update(Request $request, Category $category)
    {
        //check if is admin
        if(!Auth::user()->isAdmin){
            return redirect('/');
        }
        if (empty($category)) {
            Flash::error('Category not found');
            return redirect(route('categories.index'));
        }
        //save picture
        $folder = 'category';
        $img_request = $request->hasFile('pics');
        //check
        if(Request()->hasFile('pics')){
            $img = Request()->file('pics');
            if($category->pics != 'default.png'){
                // Delete Image
                Storage::delete('public/'. $folder .'/'.$category->pics);
            }
            $filenameToStore = $this->updateImage($img_request, $img, $folder);
            $category->pics = $filenameToStore;
        }
        //update category
        $category->update($this->validateRequest());
        return redirect(route('categories.index'))->with('success','Category Updated Successfully!');
    }

    public function destroy(Category $category)
    {

        if (empty($category)) {
            return redirect(route('categories.index'));
        }
        //delete category
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
