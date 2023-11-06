<?php

namespace Modules\Category\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Category\app\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category::index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // RedirectResponse

    public function store(Request $request)
    {
        $data = $request->all();
        $category = new Category();

        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
            $name = $data['name'][$lang];
            $slug = Str::slug($name);

            $category->setTranslation('name', $lang, $name);
            $category->setTranslation('slug', $lang, $slug);
        }

        $category->save();


        return redirect()->route('admin:categories.index');
    }


    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $currentLocale = app()->getLocale();

        $category = Category::where('slug->' . $currentLocale, $slug)->first();

        return view('category::edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $currentLocale = app()->getLocale();

        $category = Category::where('slug->' . $currentLocale, $slug)->first();
        $data = $request->all();

        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
            $name = $data['name'][$lang];
            $slug = Str::slug($name);

            $category->setTranslation('name', $lang, $name);
            $category->setTranslation('slug', $lang, $slug);
        }

        $category->save();

        return redirect()->route('admin:categories.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $currentLocale = app()->getLocale();

        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('admin:categories.index')->with('error', 'Category not found.');
        }

        $category->delete();

        return redirect()->route('admin:categories.index')->with('success', 'Category deleted successfully.');
    }
}
