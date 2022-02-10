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
        $posts = Post::all();

        return view('pages.index', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public  function getPostsByCategory($slug){
        $categories = Category::orderBy('title')->get();
        $current_category = Category::where('slug', $slug)->first();
       /* print_r($current_category->posts);
        print_r('<br><br><br>');
        print_r($current_category);*/
        //exit();
        return view('pages.index', [
            'posts' => $current_category->posts,//получаем посты конктретной категории
            'categories' => $categories
        ]);
    }
}
