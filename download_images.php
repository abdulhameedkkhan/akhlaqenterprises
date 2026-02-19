<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

echo "Setting up professional dummy images...\n";

// Function to download with retry and fallback
function downloadImage($url, $path, $name = 'Image') {
    if (File::exists($path) && File::size($path) > 1000) {
        return; // Already exists and not empty
    }
    
    if (!File::exists(dirname($path))) {
        File::makeDirectory(dirname($path), 0777, true);
    }

    try {
        echo "Downloading for: $name...\n";
        $response = Http::timeout(10)->get($url);
        if ($response->successful()) {
            File::put($path, $response->body());
            return;
        }
    } catch (\Exception $e) {
        echo "Primary fail for $name: " . $e->getMessage() . "\n";
    }

    // Ultimate Fallback: High quality placeholder
    echo "Using placeholder for $name...\n";
    $text = urlencode($name);
    $placeholder = "https://placehold.co/800x600/0f172a/ffffff?text=$text";
    $response = Http::get($placeholder);
    File::put($path, $response->body());
}

// 1. Categories
$categories = Category::all();
foreach ($categories as $cat) {
    $path = public_path("images/categories/" . \Illuminate\Support\Str::slug($cat->name) . ".jpg");
    downloadImage("https://picsum.photos/seed/cat-".crc32($cat->name)."/1200/800", $path, $cat->name);
}

// 2. Products (Main + Gallery)
$products = Product::all();
foreach ($products as $p) {
    // Main
    $mainPath = public_path($p->image);
    downloadImage("https://picsum.photos/seed/prod-main-".crc32($p->name)."/800/800", $mainPath, $p->name);
    
    // Gallery
    if ($p->gallery) {
        foreach ($p->gallery as $index => $gImg) {
            $gPath = public_path($gImg);
            downloadImage("https://picsum.photos/seed/prod-gal-".crc32($p->name).$index."/800/800", $gPath, $p->name . " Gal " . ($index+1));
        }
    }
}

// 3. Gallery Page Items
$galleryItems = Gallery::all();
foreach ($galleryItems as $item) {
    $path = public_path($item->image);
    downloadImage("https://picsum.photos/seed/gal-item-".crc32($item->title)."/1024/768", $path, $item->title);
}

echo "All dummy images are set up successfully!\n";
