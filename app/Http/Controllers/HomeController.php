<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Exercise;
use Cviebrock\EloquentTaggable\Models\Tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
/*    public function __construct()
    {
        $this->middleware('auth');
    }*/
    public function welcome()
    {
        $blogs = Blog::latest()->paginate(15);
        $cocktails = Exercise::with('category')->with('user')->where('category_id', '=', '5')->latest()->take(1)->get();
        $recipes = Exercise::with('category')->with('user')->where('category_id', '=', '6')->latest()->take(2)->get();

        $tags = Tag::pluck('name');

        return view('welcome', compact('blogs', 'cocktails', 'recipes', 'tags'));
    }
}
