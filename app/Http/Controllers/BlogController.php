<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public  function index(){

        $categories = Category::orderBy('title')->get();
         //все записи ::all()
         //все записи c сортировкой ::orderBy('title')->get()
        //$posts = Post::all();
        $posts = Post::paginate(2);

        return view('pages.index', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public  function getPostsByCategory($slug){
        $categories = Category::orderBy('title')->get();
        //::where('slug', $slug) === ::where('slug' = $slug)
        $current_category = Category::where('slug', $slug)->first();
       /* print_r($current_category->posts);
        print_r('<br><br><br>');
        print_r($current_category);*/
        //exit();
        return view('pages.index', [
            'posts' => $current_category->posts()->paginate(5),//получаем посты конктретной категории
            'categories' => $categories
        ]);
    }

    public  function getPosts($slug_category, $slug_post){
        $categories = Category::orderBy('title')->get();
        $post = Post::where('slug', $slug_post)->first();

        return view('pages.show-post', [
            'post' => $post,
            'categories' => $categories,
            'slug_category' => $slug_category
        ]);
    }
}
