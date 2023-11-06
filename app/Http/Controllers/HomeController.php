<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Blog\app\Models\Blog;
use Modules\Category\app\Models\Category;

class HomeController extends Controller
{
    public function index() {
        $blogs = Blog::paginate(10);
        $categories = Category::all();
        return view('home', compact('blogs', 'categories'));
    }

    public function category($slug)
    {

        $currentLocale = app()->getLocale();
        $category = Category::where('slug->' . $currentLocale, $slug)->first();

        if (!$category) {
            abort(404);
        }

        $blogs = $category->blogs()->paginate(10);
        $categories = Category::all();

        return view('home', compact('blogs', 'categories'));
    }



    public function blog($slug) {
        
        $currentLocale = app()->getLocale();
        $blog = Blog::where('slug->' . $currentLocale, $slug)->first();
        $categories = Category::all();

        return view('blog', compact('blog', 'categories'));

    }
}
