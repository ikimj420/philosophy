<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Exercise;
use App\Http\Controllers\AppBaseController;

class FavoriteController extends AppBaseController
{
    /**
     * Store a newly created Favorite in storage.
     *
     * @param CreateFavoriteRequest $request
     *
     * @return Response
     */
    public function saveExercise($id)
    {
        $favorite = Exercise::findorFail($id);
        $favorite->addFavorite(); // auth user added to favorites this exercise

        return back()->with('success','Exercise Added Successfully To Favorite!');
    }

    public function saveBlog($id)
    {
        $favorite = Blog::findorFail($id);
        $favorite->addFavorite(); // auth user added to favorites this blog

        return back()->with('success','Blog Added Successfully To Favorite!');
    }

    /**
     * Remove the specified Favorite from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroyExercise($id)
    {
        $exercise = Exercise::findorFail($id);
        $exercise->removeFavorite(); // auth user removed from favorites this exercise

        return back()->with('success','Exercise Successfully Removed From Favorite!');
    }

    public function destroyBlog($id)
    {
        $blog = Blog::findorFail($id);
        $blog->removeFavorite(); // auth user removed from favorites this blog

        return back()->with('success','Blog Successfully Removed From Favorite!');
    }
}
