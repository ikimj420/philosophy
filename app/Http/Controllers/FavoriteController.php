<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Exercise;
use App\Http\Controllers\AppBaseController;
use Flash;
use Response;
Use Auth;

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

        Flash::success('Favorite saved successfully.');

        return back();
    }

    public function saveBlog($id)
    {
        $favorite = Blog::findorFail($id);
        $favorite->addFavorite(); // auth user added to favorites this blog

        Flash::success('Favorite saved successfully.');

        return back();
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
        Flash::success('Favorite deleted successfully.');
        return back();
    }

    public function destroyBlog($id)
    {
        $blog = Blog::findorFail($id);
        $blog->removeFavorite(); // auth user removed from favorites this blog

        Flash::success('Favorite deleted successfully.');
        return back();
    }
}
