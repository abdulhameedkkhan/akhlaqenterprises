<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Gallery;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'gallery' => Gallery::count(),
        ];
        
        $recentProducts = Product::with('category')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recentProducts'));
    }
}
