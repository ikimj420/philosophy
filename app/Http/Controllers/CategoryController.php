<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\Storage;

class CategoryController extends AppBaseController
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
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
        $category = Category::create($this->validateRequest());

        $img_request = $request->hasFile('pics');
        $img = $request->file('pics');
        $folder = 'category';
        $filenameToStore = $this->createImage($img_request, $img, $folder);
        $category->pics = $filenameToStore;

        $category->save();

        Flash::success('Category saved successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified Category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

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
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

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

        Flash::success('Category updated successfully.');
        return redirect(route('categories.index'));
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
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }
        $category->delete();
        if($category->pics != 'default.png'){
            // Delete Image
            Storage::delete('public/category/'.$category->pics);
        }

        Flash::success('Category deleted successfully.');

        return redirect(route('categories.index'));
    }

    private function validateRequest()
    {
        return request()->validate([
            'title' => 'required|min:4',
            'desc' => 'sometimes',

            //no pics $category->pics = $filenameToStore;
            'filenameToStore' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }
}
