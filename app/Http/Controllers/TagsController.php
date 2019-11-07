<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Exercise;


class TagsController extends Controller
{
    public function index($tag)
    {
        $blogs = Blog::withAllTags([$tag])->get();
        $exercises = Exercise::withAllTags([$tag])->get();

        return view('tags.index', compact('blogs', 'exercises'));
    }
}