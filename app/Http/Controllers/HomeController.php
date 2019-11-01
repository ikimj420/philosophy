<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function welcome(Exercise $exercise, Blog $blog)
    {
        $post = $blog::allTagModels();
        $exercises = $exercise::allTagModels();

        $blogs = Blog::latest()->paginate(15);
        $cocktails = Exercise::with('category')->with('user')->where('category_id', '=', '5')->latest()->take(1)->get();
        $recipes = Exercise::with('category')->with('user')->where('category_id', '=', '6')->latest()->take(2)->get();

        return view('welcome', compact('blogs', 'cocktails', 'recipes', 'post', 'exercises', 'blog'));
    }
}
