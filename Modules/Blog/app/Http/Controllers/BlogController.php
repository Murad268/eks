<?php

namespace Modules\Blog\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\ImageService;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Blog\app\Models\Blog;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Modules\Blog\app\Http\Requests\BlogCreateRequest;
use Modules\Blog\app\Http\Requests\BlogUpdateRequest;
use Modules\Category\app\Models\Category;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private ImageService $imageService)
    {
    }
    public function index()
    {
        $blogs = Blog::all();

        return view('blog::index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('blog::create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCreateRequest $request): RedirectResponse
    {
        $data = $request->all();
        $category = new Blog();

        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
            $name = $data['title'][$lang];
            $desc = $data['desc'][$lang];
            $slug = Str::slug($name);

            $category->setTranslation('title', $lang, $name);
            $category->setTranslation('slug', $lang, $slug);
            $category->setTranslation('desc', $lang, $desc);
        }

        $category->image = $this->imageService->downloadImage($request, 'assets/images/', 'image', 'noimage.png');
        $category->banner = $this->imageService->downloadImage($request, 'assets/images/', 'banner', 'noimage.png');

        $category->category_id = $request->category_id;
        $category->save();

        return redirect()->route('admin:blogs.index');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('blog::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $currentLocale = app()->getLocale();
        $categories = Category::all();
        $blog = Blog::where('slug->' . $currentLocale, $slug)->first();
        return view('blog::edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogUpdateRequest $request, Blog $blog): RedirectResponse
    {
        $data = $request->all();

        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
            $name = $data['title'][$lang];
            $desc = $data['desc'][$lang];
            $slug = Str::slug($name);

            $blog->setTranslation('title', $lang, $name);
            $blog->setTranslation('slug', $lang, $slug);
            $blog->setTranslation('desc', $lang, $desc);
        }

        $blog->banner = $this->imageService->updateImage($request, 'assets/images/', 'banner', $blog->banner);
        $blog->image = $this->imageService->updateImage($request, 'assets/images/', 'image', $blog->image);

        $blog->category_id = $request->category_id;


        $blog->save();

        return redirect()->route('admin:blogs.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return redirect()->route('admin:blogs.index')->with('error', 'Blog not found');
        }

        $blog->delete();

        return redirect()->route('admin:blogs.index')->with('success', 'Blog deleted successfully');
    }
}
