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
use Image;
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
    public function index(Category $category, Request $request)
    {
        $categories = Category::latest()->paginate(10);

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
    public function store(CreateCategoryRequest $request, Category $category)
    {
/*        $input = $request->all();
        $category = $this->categoryRepository->create($input);*/
        $category = Category::create($this->validateRequest());

        $this->storeImage($category);
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
    public function update( UpdateCategoryRequest $request, Category $category)
    {
        //$category = $this->categoryRepository->find($id);
        if (empty($category)) {
            Flash::error('Category not found');
            return redirect(route('categories.index'));
        }
        //$category = $this->categoryRepository->update($request->all(), $id);
        $category->update($this->validateRequest());
        $this->storeImage($category);

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
        //$category = $this->categoryRepository->find($id);
//dd( asset('storage/'.$category->pics));
        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }
        Storage::delete(asset('storage/'.$category->pics));

        $category->delete();
        //$this->categoryRepository->delete($id);
        Flash::success('Category deleted successfully.');

        return redirect(route('categories.index'));
    }

    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required|min:3',
            'desc' => 'sometimes',
            'pics' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:5000'
        ]);
    }

    private function storeImage(Category $category)
    {
        if (request()->has('pics')) {
            $category->update([ 'pics' => request()->pics->store('category', 'public')]);

            $image = Image::make(public_path('storage/'.$category->pics))->fit(500, 500);
            $image->save();
        }
    }
}
