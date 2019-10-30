<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Exercise;
use App\Models\Favorite;
use App\Repositories\FavoriteRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Response;
Use Auth;

class FavoriteController extends AppBaseController
{
    /** @var  FavoriteRepository */
    private $favoriteRepository;

    public function __construct(FavoriteRepository $favoriteRepo)
    {
        $this->favoriteRepository = $favoriteRepo;
    }

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
    public function destroyExercise(Favorite $favorite, $id)
    {
        $favorite = Favorite::where('favoriteable_id', '=', $id);
        if (empty($favorite)) {
            Flash::error('Favorite not found');

            return redirect(route('favorites.index'));
        }
        $favorite->delete();
        Flash::success('Favorite deleted successfully.');
        return back();
    }

    public function destroyBlog(Favorite $favorite, $id)
    {
        $favorite = Favorite::where('favoriteable_id', '=', $id);
        if (empty($favorite)) {
            Flash::error('Favorite not found');

            return redirect(route('favorites.index'));
        }
        $favorite->delete();
        Flash::success('Favorite deleted successfully.');
        return back();
    }
}
