<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Exercise;


class TagsController extends Controller
{
    public function index($tag)
    {
        //get all tag for blog
        $blogs = Blog::withAllTags([$tag])->get();
        //get all tag for exercise
        $exercises = Exercise::withAllTags([$tag])->get();
        return view('tags.index', compact('blogs', 'exercises'));
    }
}
