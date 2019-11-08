<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Exercise;
use Cviebrock\EloquentTaggable\Models\Tag;

class HomeController extends Controller
{

    public function welcome()
    {
        //get latest blog
        $blogs = Blog::latest()->paginate(12);
        //get latest 1 cocktail from Exercise
        $cocktails = Exercise::with('category')->with('user')->where('category_id', '=', '5')->latest()->take(1)->get();
        //get latest 2 food from Exercise
        $recipes = Exercise::with('category')->with('user')->where('category_id', '=', '6')->latest()->take(2)->get();
        //get from all tags only name
        $tags = Tag::pluck('name');
        return view('welcome', compact('blogs', 'cocktails', 'recipes', 'tags'));
    }
}
