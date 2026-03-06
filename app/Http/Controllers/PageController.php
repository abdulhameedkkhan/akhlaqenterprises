<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $categories = \Cache::remember('all_categories', 3600, function() {
            return \App\Models\Category::orderBy('name')->get();
        });
        return view('home', compact('categories'));
    }

    public function about()
    {
        return view('about');
    }



    public function gallery()
    {
        $galleryItems = \Cache::remember('gallery_items', 3600, function() {
            return \App\Models\Gallery::all()->groupBy('category');
        });
        return view('gallery', compact('galleryItems'));
    }

    public function contact()
    {
        return view('contact');
    }
}
