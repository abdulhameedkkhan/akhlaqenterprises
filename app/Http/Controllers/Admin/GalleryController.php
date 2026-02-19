<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        $galleryItems = Gallery::latest()->paginate(12);
        return view('admin.gallery.index', compact('galleryItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'image' => 'required|image|max:2048',
            'description' => 'nullable|string'
        ]);

        $item = new Gallery($request->all());
        
        if ($request->hasFile('image')) {
            $name = time() . '_' . Str::slug($request->title) . '.' . $request->image->extension();
            $request->image->move(public_path('images/gallery'), $name);
            $item->image = 'images/gallery/' . $name;
        }

        $item->save();

        return back()->with('success', 'Gallery item added successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return back()->with('success', 'Gallery item removed successfully.');
    }
}
