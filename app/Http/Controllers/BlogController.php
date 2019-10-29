<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Repositories\BlogRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use Illuminate\Support\Facades\Storage;

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
    public function index()
    {
        $blogs = Blog::with('category')->latest()->paginate(15);

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
    public function store(Request $request, User $user, Blog $blog)
    {
        $blog = Blog::create($this->validateRequest());

        $this->User($blog);

        $img_request = $request->hasFile('pics');
        $img = $request->file('pics');
        $folder = 'blog';
        $filenameToStore = $this->createImage($img_request, $img, $folder);
        $blog->pics = $filenameToStore;

        $blog->save();

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
    public function show(Blog $blog)
    {
        if (empty($blog)) {
            Flash::error('Blog not found');

            return redirect(route('blogs.index'));
        }

        return view('blogs.show', compact('blog'));
    }
    public function code()
    {
        $code = Blog::where('category_id', '=', '4')->latest()->paginate(10);
        if (empty($code)) {
            Flash::error('Blog not found');
            return redirect(route('blogs.index'));
        }
        return view('blogs.code', compact('code'));
    }
    public function audio()
    {
        $audio = Blog::where('category_id', '=', '3')->latest()->paginate(10);
        if (empty($audio)) {
            Flash::error('Blog not found');
            return redirect(route('blogs.index'));
        }
        return view('blogs.audio', compact('audio'));
    }
    public function video()
    {
        $video = Blog::where('category_id', '=', '2')->latest()->paginate(10);
        if (empty($video)) {
            Flash::error('Blog not found');
            return redirect(route('blogs.index'));
        }
        return view('blogs.video', compact('video'));
    }
    public function standard()
    {
        $standard = Blog::where('category_id', '=', '1')->latest()->paginate(10);
        if (empty($standard)) {
            Flash::error('Blog not found');
            return redirect(route('blogs.index'));
        }
        return view('blogs.standard', compact('standard'));
    }

    /**
     * Show the form for editing the specified Blog.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit(Blog $blog)
    {
        $categories = Category::get();

        if (empty($blog)) {
            Flash::error('Blog not found');

            return redirect(route('blogs.index'));
        }

        return view('blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified Blog in storage.
     *
     * @param int $id
     * @param UpdateBlogRequest $request
     *
     * @return Response
     */
    public function update(Request $request, Blog $blog, User $user)
    {
        $categories = Category::get();

        if (empty($blog)) {
            Flash::error('Blog not found');

            return redirect(route('blogs.index'));
        }

        $this->User($blog);

        $folder = 'blog';
        $img_request = $request->hasFile('pics');

        if(Request()->hasFile('pics')){
            $img = Request()->file('pics');
            if($blog->pics != 'default.png'){
                // Delete Image
                Storage::delete('public/'. $folder .'/'.$blog->pics);
            }
            $filenameToStore = $this->updateImage($img_request, $img, $folder);
            $blog->pics = $filenameToStore;
        }

        $blog->update($this->validateRequest());

        Flash::success('Blog updated successfully.');

        return redirect(route('blogs.index', compact('categories')));
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
    public function destroy(Blog $blog)
    {
        if (empty($blog)) {
            Flash::error('Blog not found');

            return redirect(route('blogs.index'));
        }

        $blog->delete();
        if($blog->pics != 'default.png'){
            // Delete Image
            Storage::delete('public/blog/'.$blog->pics);
        }

        Flash::success('Blog deleted successfully.');

        return redirect(route('blogs.index'));
    }

    private function validateRequest()
    {
        return request()->validate([
            'title' => 'required|min:4',
            'body' => 'required',

            'user_id' => 'sometimes',
            'category_id' => 'sometimes',
            'code' => 'sometimes',
            'audio' => 'sometimes',
            'video' => 'sometimes',
            //no pics $blog->pics = $filenameToStore;
            'filenameToStore' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    private function User(Blog $blog)
    {
        $blog->update([ 'user_id' => Auth::user()->id]);
    }
}
