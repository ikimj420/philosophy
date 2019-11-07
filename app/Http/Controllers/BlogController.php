<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BlogController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'code', 'audio', 'video', 'standard');
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
        $id = Auth::id();
        $blogs = Blog::with('category')->where('user_id', '=', $id)->latest()->paginate(15);

        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new Blog.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::where('subCategory', '=', '1')->get();

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
        $tags = explode(',', $request->blog_tag);
        $blog = Blog::create($this->validateRequest());

        $this->User($blog);

        $img_request = $request->hasFile('pics');
        $img = $request->file('pics');
        $folder = 'blog';
        $filenameToStore = $this->createImage($img_request, $img, $folder);
        $blog->pics = $filenameToStore;

        $blog->tag($tags);

        $blog->save();

        return redirect(route('blogs.index'))->with('success','Blog Created Successfully!');
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
        $fav = $blog->isFavorited(); // returns a boolean with true or false.
        if (empty($blog)) {
            return redirect(route('blogs.index'));
        }

        return view('blogs.show', compact('blog', 'fav'));
    }
    public function code()
    {
        $code = Blog::where('category_id', '=', '4')->latest()->paginate(10);
        if (empty($code)) {
            return redirect(route('blogs.index'));
        }
        return view('blogs.code', compact('code'));
    }
    public function audio()
    {
        $audio = Blog::where('category_id', '=', '3')->latest()->paginate(10);
        if (empty($audio)) {
            return redirect(route('blogs.index'));
        }
        return view('blogs.audio', compact('audio'));
    }
    public function video()
    {
        $video = Blog::where('category_id', '=', '2')->latest()->paginate(10);
        if (empty($video)) {
            return redirect(route('blogs.index'));
        }
        return view('blogs.video', compact('video'));
    }
    public function standard()
    {
        $standard = Blog::where('category_id', '=', '1')->latest()->paginate(10);
        if (empty($standard)) {
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
        if(Auth::id() !== $blog->user_id && Auth::user()->isAdmin !== 1){
            return redirect('/');
        }

        $categories = Category::where('subCategory', '=', '1')->get();

        if (empty($blog)) {
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
        $tags = explode(',', $request->blog_tag);
        $categories = Category::get();

        if (empty($blog)) {
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

        $blog->retag($tags);

        return redirect(route('blogs.index', compact('categories')))->with('success','Blog Updated Successfully!');
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
            return redirect(route('blogs.index'));
        }

        $blog->delete();
        if($blog->pics != 'default.png'){
            // Delete Image
            Storage::delete('public/blog/'.$blog->pics);
        }

        return redirect(route('blogs.index'))->with('success','Blog Deleted Successfully!');
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
            'tag' => 'sometimes',
            //no pics $blog->pics = $filenameToStore;
            'filenameToStore' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    private function User(Blog $blog)
    {
        $blog->update([ 'user_id' => Auth::user()->id]);
    }
}
