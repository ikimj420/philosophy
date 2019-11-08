<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Exercise;
use App\Http\Controllers\AppBaseController;

class FavoriteController extends AppBaseController
{

    public function saveExercise($id)
    {
        //find exercise by id
        $favorite = Exercise::findorFail($id);
        // auth user added to favorites this exercise
        $favorite->addFavorite();
        return back()->with('success','Exercise Added Successfully To Favorite!');
    }

    public function saveBlog($id)
    {
        //find blog by id
        $favorite = Blog::findorFail($id);
        // auth user added to favorites this blog
        $favorite->addFavorite();
        return back()->with('success','Blog Added Successfully To Favorite!');
    }

    public function destroyExercise($id)
    {
        //find exercise by id
        $exercise = Exercise::findorFail($id);
        // auth user removed from favorites this exercise
        $exercise->removeFavorite();
        return back()->with('success','Exercise Successfully Removed From Favorite!');
    }

    public function destroyBlog($id)
    {
        //find blog by id
        $blog = Blog::findorFail($id);
        // auth user removed from favorites this blog
        $blog->removeFavorite();
        return back()->with('success','Blog Successfully Removed From Favorite!');
    }
}
