<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $featuredProducts = \App\Models\Product::with('category')->inRandomOrder()->limit(4)->get();
        return view('home', compact('featuredProducts'));
    }

    public function about()
    {
        return view('about');
    }



    public function gallery()
    {
        $galleryItems = \App\Models\Gallery::all()->groupBy('category');
        return view('gallery', compact('galleryItems'));
    }

    public function contact()
    {
        return view('contact');
    }
}
