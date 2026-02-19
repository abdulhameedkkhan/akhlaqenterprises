<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $product = new Product($data);
        $product->slug = Str::slug($request->name);
        
        // Handle Main Image
        if ($request->hasFile('image')) {
            $imageName = 'main_' . time() . '.' . $request->image->extension();
            $directory = public_path('images/products/' . $product->slug);
            
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }

            $request->image->move($directory, $imageName);
            $product->image = 'images/products/' . $product->slug . '/' . $imageName;
        } else {
            $product->image = 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?auto=format&fit=crop&q=80&w=800';
        }

        // Handle Gallery Images
        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            $galleryDir = public_path('images/products/' . $product->slug . '/gallery');
            
            if (!File::isDirectory($galleryDir)) {
                File::makeDirectory($galleryDir, 0755, true, true);
            }

            foreach ($request->file('gallery') as $index => $file) {
                $fileName = 'gallery_' . time() . '_' . $index . '.' . $file->extension();
                $file->move($galleryDir, $fileName);
                $galleryPaths[] = 'images/products/' . $product->slug . '/gallery/' . $fileName;
            }
            $product->gallery = $galleryPaths;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Increased size and added webp
        ]);

        $product->fill($data);
        
        // Handle Main Image Update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && !Str::startsWith($product->image, 'http') && File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }
            
            $slug = $product->slug ?: Str::slug($product->name);
            $imageName = 'main_' . time() . '.' . $request->image->extension();
            $directory = public_path('images/products/' . $slug);
            
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }

            $request->image->move($directory, $imageName);
            $product->image = 'images/products/' . $slug . '/' . $imageName;
        }

        // Handle Gallery Images Update
        if ($request->hasFile('gallery')) {
            $galleryPaths = $product->gallery ?? [];
            
            // If user checked "Replace entire gallery"
            if ($request->boolean('replace_gallery')) {
                if ($product->gallery) {
                    foreach ($product->gallery as $oldPath) {
                        if (File::exists(public_path($oldPath))) {
                            File::delete(public_path($oldPath));
                        }
                    }
                }
                $galleryPaths = []; // Reset array
            }

            foreach ($request->file('gallery') as $index => $file) {
                $fileName = 'gallery_' . time() . '_' . $index . '.' . $file->extension();
                $file->move(public_path('images/products/' . $product->slug . '/gallery'), $fileName);
                $galleryPaths[] = 'images/products/' . $product->slug . '/gallery/' . $fileName;
            }
            $product->gallery = $galleryPaths;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function deleteGalleryImage(Product $product, $index)
    {
        $gallery = $product->gallery;
        if (isset($gallery[$index])) {
            $path = public_path($gallery[$index]);
            if (File::exists($path)) {
                File::delete($path);
            }
            unset($gallery[$index]);
            $product->gallery = array_values($gallery); // Re-index array
            $product->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Image not found.'], 404);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
