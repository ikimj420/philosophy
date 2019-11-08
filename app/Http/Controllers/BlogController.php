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
    //auth user create update delete
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'code', 'audio', 'video', 'standard');
    }

    public function index()
    {
        //get auth user id
        $id = Auth::id();
        //get latest blog for auth user paginate 15 and send to index
        $blogs = Blog::where('user_id', '=', $id)->latest()->paginate(15);
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        //send categories with subCategory 1 to func store
        $categories = Category::where('subCategory', '=', '1')->get();
        return view('blogs.create', compact('categories'));
    }

    public function store(Request $request, User $user, Blog $blog)
    {
        //explode tags by ,
        $tags = explode(',', $request->blog_tag);
        //validate data and create without user and pics
        $blog = Blog::create($this->validateRequest());
        //add auth user
        $this->User($blog);
        //add pics
        $img_request = $request->hasFile('pics');
        $img = $request->file('pics');
        $folder = 'blog';
        $filenameToStore = $this->createImage($img_request, $img, $folder);
        $blog->pics = $filenameToStore;
        //add tags
        $blog->tag($tags);
        //save blog
        $blog->save();
        return redirect(route('blogs.index'))->with('success','Blog Created Successfully!');
    }

    public function show(Blog $blog)
    {
        // returns a boolean with true or false
        $fav = $blog->isFavorited();
        if (empty($blog)) {
            return redirect(route('blogs.index'));
        }
        return view('blogs.show', compact('blog', 'fav'));
    }

    public function code()
    {
        //get blog where category id
        $code = Blog::where('category_id', '=', '4')->latest()->paginate(10);
        if (empty($code)) {
            return redirect(route('blogs.index'));
        }
        return view('blogs.code', compact('code'));
    }

    public function audio()
    {
        //get blog where category id
        $audio = Blog::where('category_id', '=', '3')->latest()->paginate(10);
        if (empty($audio)) {
            return redirect(route('blogs.index'));
        }
        return view('blogs.audio', compact('audio'));
    }

    public function video()
    {
        //get blog where category id
        $video = Blog::where('category_id', '=', '2')->latest()->paginate(10);
        if (empty($video)) {
            return redirect(route('blogs.index'));
        }
        return view('blogs.video', compact('video'));
    }

    public function standard()
    {
        //get blog where category id
        $standard = Blog::where('category_id', '=', '1')->latest()->paginate(10);
        if (empty($standard)) {
            return redirect(route('blogs.index'));
        }
        return view('blogs.standard', compact('standard'));
    }

    public function edit(Blog $blog)
    {
        //check for blog user and if is admin
        if(Auth::id() !== $blog->user_id && Auth::user()->isAdmin !== 1){
            return redirect('/');
        }
        //get categories with subCategory send to update
        $categories = Category::where('subCategory', '=', '1')->get();
        if (empty($blog)) {
            return redirect(route('blogs.index'));
        }
        return view('blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog, User $user)
    {
        //explode tags by ,
        $tags = explode(',', $request->blog_tag);
        //get categories send from edit
        $categories = Category::get();
        if (empty($blog)) {
            return redirect(route('blogs.index'));
        }
        //save auth user
        $this->User($blog);
        //save picture
        $folder = 'blog';
        $img_request = $request->hasFile('pics');
        //check for picture
        if(Request()->hasFile('pics')){
            $img = Request()->file('pics');
            if($blog->pics != 'default.png'){
                // Delete Image
                Storage::delete('public/'. $folder .'/'.$blog->pics);
            }
            $filenameToStore = $this->updateImage($img_request, $img, $folder);
            $blog->pics = $filenameToStore;
        }
        //update blog
        $blog->update($this->validateRequest());
        //retag
        $blog->retag($tags);
        return redirect(route('blogs.index', compact('categories')))->with('success','Blog Updated Successfully!');
    }

    public function destroy(Blog $blog)
    {
        if (empty($blog)) {
            return redirect(route('blogs.index'));
        }
        //delete blog
        $blog->delete();
        //delete picture
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
            'category_id' => 'required',

            'user_id' => 'sometimes',
            'code' => 'sometimes',
            'audio' => 'sometimes',
            'video' => 'sometimes',
            'tag' => 'sometimes',
            //no pics $blog->pics = $filenameToStore;
            'filenameToStore' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    //func get auth user to save user_id
    private function User(Blog $blog)
    {
        $blog->update([ 'user_id' => Auth::user()->id]);
    }
}
