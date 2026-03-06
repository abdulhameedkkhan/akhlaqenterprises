<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ReplaceShadWithSladFishCommand extends Command
{
    protected $signature = 'products:replace-shad-with-slad-fish';

    protected $description = 'Replace Sea Water product "Shad" with "Slad Fish" and set image from Slad.avif';

    public function handle(): int
    {
        $category = Category::where('name', 'Sea Water Fish')->first();
        if (!$category) {
            $this->error('Category "Sea Water Fish" not found.');
            return self::FAILURE;
        }

        $product = Product::where('category_id', $category->id)->where('name', 'Shad')->first();
        if (!$product) {
            $this->error('Product "Shad" not found in Sea Water Fish.');
            return self::FAILURE;
        }

        $sourcePath = 'C:\Users\hp\OneDrive\Desktop\ae-gll\new_prod\sea water\Slad.avif';
        if (!is_file($sourcePath)) {
            $this->error("Image not found: {$sourcePath}");
            return self::FAILURE;
        }

        $newSlug = 'slad-fish';
        $n = 0;
        while (Product::where('slug', $newSlug)->where('id', '!=', $product->id)->exists()) {
            $n++;
            $newSlug = 'slad-fish-' . $n;
        }

        $destDir = public_path('images/products/' . $newSlug);
        if (!File::isDirectory($destDir)) {
            File::makeDirectory($destDir, 0755, true, true);
        }

        $destName = 'main_' . time() . '_' . $product->id . '.avif';
        $destPath = $destDir . DIRECTORY_SEPARATOR . $destName;

        if (!copy($sourcePath, $destPath)) {
            $this->error('Failed to copy image.');
            return self::FAILURE;
        }

        $product->update([
            'name' => 'Slad Fish',
            'slug' => $newSlug,
            'image' => 'images/products/' . $newSlug . '/' . $destName,
        ]);

        $this->info('Done: "Shad" → "Slad Fish", image set from Slad.avif');
        return self::SUCCESS;
    }
}
