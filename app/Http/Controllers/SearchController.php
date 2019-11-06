<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Exercise;
use App\User;
use Cviebrock\EloquentTaggable\Models\Tag;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $users = User::where('username','LIKE','%'.$request->search."%")->get();
            $blogs = Blog::where('title','LIKE','%'.$request->search."%")->get();
            $exercises = Exercise::where('title','LIKE','%'.$request->search."%")->get();
            $categoriesBlog = Category::where('id', '<=', 4)->where('name','LIKE','%'.$request->search."%")->get();
            $categoriesExercise = Category::where('id', '>=', 5)->where('name','LIKE','%'.$request->search."%")->get();
            $tags = Tag::where('name','LIKE','%'.$request->search."%")->get();


            if($users || $blogs || $exercises || $categoriesBlog || $tags)
            {
                foreach ($users as $user) {
                    $output.='<a href="/profiles/'.$user->id.'">'.$user->username.'</a> <br>';
                }
                foreach ($blogs as $blog) {
                    $output.='<a href="/blogs/'.$blog->id.'">'.$blog->title.'</a> <br>';
                }
                foreach ($exercises as  $exercise) {
                    $output.='<a href="/exercises/'.$exercise->id.'">'.$exercise->title.'</a> <br>';
                }
                foreach ($categoriesBlog as  $categoryBlog) {
                    $output.='<a href="/blogs/blog/'.$categoryBlog->id.'">'.$categoryBlog->name.'</a> <br>';
                }
                foreach ($categoriesExercise as  $categoriesExercis) {
                    $output.='<a href="/exercises/exercise/'.$categoriesExercis->id.'">'.$categoriesExercis->name.'</a> <br>';
                }
                foreach ($tags as  $tag) {
                    $output.='<a href="/tag/tags/'.$tag->name.'">'.$tag->name.'</a> <br>';
                }
                if(!empty($output))
                    return Response($output);
                else
                    return 'Nothing Found';
            }
        }
    }
}
