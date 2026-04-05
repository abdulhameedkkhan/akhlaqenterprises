<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Product::with('category')->active();

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by Category (slug-friendly URL for SEO; numeric IDs still supported)
        if ($request->filled('category') && $request->category !== 'all') {
            $categoryFilter = $request->category;

            if (is_numeric($categoryFilter)) {
                $categoryId = (int) $categoryFilter;
            } else {
                $slug = \Illuminate\Support\Str::slug($categoryFilter);
                $category = \App\Models\Category::where('slug', $slug)
                    ->orWhereRaw('LOWER(name) = ?', [strtolower($categoryFilter)])
                    ->first();
                $categoryId = $category ? $category->id : null;
            }

            if ($categoryId) {
                $query->where('category_id', $categoryId);
            } else {
                $query->whereRaw('0 = 1');
            }
        }

        // Pagination (preserve ?category= & ?search= on page links and AJAX next_page_url)
        $products = $query->paginate(12)->withQueryString();

        // AJAX response for "Load More" or Search
        if ($request->ajax() || $request->query('ajax')) {
            return response()->json([
                'html' => view('products.partials.list', compact('products'))->render(),
                'next_page_url' => $products->nextPageUrl(),
                'total' => $products->total(),
            ]);
        }

        $categories = \Cache::remember('all_categories', 3600, function() {
            return \App\Models\Category::all();
        });

        return view('products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = \App\Models\Product::with('category')->active()->where('slug', $slug)->firstOrFail();
        $relatedProducts = \App\Models\Product::with('category')
            ->active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();
            
        return view('products.show', compact('product', 'relatedProducts'));
    }
}
