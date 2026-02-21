<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $featuredProducts = \Cache::remember('featured_products', 3600, function() {
            return \App\Models\Product::with('category')->limit(4)->get();
        });
        return view('home', compact('featuredProducts'));
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
