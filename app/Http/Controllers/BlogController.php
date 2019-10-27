<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Repositories\BlogRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Intervention\Image\Facades\Image;
use Response;
use Auth;

class BlogController extends AppBaseController
{
    /** @var  BlogRepository */
    private $blogRepository;

    public function __construct(BlogRepository $blogRepo)
    {
        $this->blogRepository = $blogRepo;
    }

    /**
     * Display a listing of the Blog.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Blog $blogs)
    {
        $blogs = Blog::latest()->paginate(10);

        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new Blog.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::get();

        return view('blogs.create', compact('categories'));
    }

    /**
     * Store a newly created Blog in storage.
     *
     * @param CreateBlogRequest $request
     *
     * @return Response
     */
    public function store(CreateBlogRequest $request, Blog $blog)
    {
        $blog = Blog::create($this->validateRequest());

        $this->User($blog);
        $this->storeImage($blog);

        Flash::success('Blog saved successfully.');

        return redirect(route('blogs.index'));
    }

    /**
     * Display the specified Blog.
     *
     * @param int $id
     *
     * @return Response
     */
/*    public function show(Blog $blog)
    {

        if (empty($blog)) {
            Flash::error('Blog not found');

            return redirect(route('blogs.index'));
        }

        return view('blogs.show')->with('blog', $blog);
    }*/

    public function code(Blog $blogs)
    {
        $blogs = Blog::with('category')->where('category_id', '=', 4)->latest()->paginate(10);

        if (empty($blogs)) {
            Flash::error('Blog not found');

            return redirect(route('blogs.index'));
        }

        return view('blogs.code')->with('blogs', $blogs);
    }

    public function showcode(Blog $blog)
    {

        if (empty($blog)) {
            Flash::error('Blog not found');

            return redirect(route('blogs.index'));
        }

        return view('blogs.blog.showcode')->with('blog', $blog);
    }

    public function audio(Blog $blogs)
    {
        $blogs = Blog::with('category')->where('category_id', '=', 3)->latest()->paginate(10);

        if (empty($blogs)) {
            Flash::error('Blog not found');

            return redirect(route('blogs.index'));
        }

        return view('blogs.audio')->with('blogs', $blogs);
    }

    public function showaudio(Blog $blog)
    {

        if (empty($blog)) {
            Flash::error('Blog not found');

            return redirect(route('blogs.index'));
        }

        return view('blogs.blog.showaudio')->with('blog', $blog);
    }

    public function video(Blog $blogs)
    {
        $blogs = Blog::with('category')->where('category_id', '=', 2)->latest()->paginate(10);

        if (empty($blogs)) {
            Flash::error('Blog not found');

            return redirect(route('blogs.index'));
        }

        return view('blogs.video')->with('blogs', $blogs);
    }

    public function showvideo(Blog $blog)
    {

        if (empty($blog)) {
            Flash::error('Blog not found');

            return redirect(route('blogs.index'));
        }

        return view('blogs.blog.showvideo')->with('blog', $blog);
    }

    public function standard(Blog $blogs)
    {
        $blogs = Blog::with('category')->where('category_id', '=', 1)->latest()->paginate(10);

        if (empty($blogs)) {
            Flash::error('Blog not found');

            return redirect(route('blogs.index'));
        }

        return view('blogs.standard')->with('blogs', $blogs);
    }

    public function showstandard(Blog $blog)
    {

        if (empty($blog)) {
            Flash::error('Blog not found');

            return redirect(route('blogs.index'));
        }

        return view('blogs.blog.showstandard')->with('blog', $blog);
    }

    /**
     * Show the form for editing the specified Blog.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $blog = $this->blogRepository->find($id);
        $categories = Category::get();


        if (empty($blog)) {
            Flash::error('Blog not found');

            return redirect(route('blogs.index'));
        }

        return view('blogs.edit', compact('blog','categories'));
    }

    /**
     * Update the specified Blog in storage.
     *
     * @param int $id
     * @param UpdateBlogRequest $request
     *
     * @return Response
     */
    public function update(Blog $blog)
    {

        if (empty($blog)) {
            Flash::error('Blog not found');

            return redirect(route('blogs.index'));
        }

        $blog->update($this->validateRequest());

        $this->User($blog);
        $this->storeImage($blog);

        Flash::success('Blog updated successfully.');

        return redirect(route('blogs.index'));
    }

    /**
     * Remove the specified Blog from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $blog = $this->blogRepository->find($id);

        if (empty($blog)) {
            Flash::error('Blog not found');

            return redirect(route('blogs.index'));
        }

        $this->blogRepository->delete($id);

        Flash::success('Blog deleted successfully.');

        return redirect(route('blogs.index'));
    }

    private function validateRequest()
    {
        return request()->validate([
            'category_id' => 'required',
            'title' => 'required|min:5',
            'body' => 'required',

            'video' => 'sometimes',
            'pics' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:5000'
        ]);
    }

    private function User($blog)
    {
        $blog->update([ 'user_id' => Auth::user()->id]);
    }

    private function storeImage(Blog $blog)
    {
        if (request()->has('pics')) {
            $blog->update([ 'pics' => request()->pics->store('blog', 'public')]);

            $image = Image::make(public_path('storage/'.$blog->pics))->fit(1000, 1000);
            $image->save();
        }
    }
}
