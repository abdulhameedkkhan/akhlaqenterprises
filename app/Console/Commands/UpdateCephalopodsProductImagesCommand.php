<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateCephalopodsProductImagesCommand extends Command
{
    protected $signature = 'products:update-cephalopods-images {--dir= : Local folder path with product images}';

    protected $description = 'Set images for Cephalopods products from local folder';

    private string $sourceDir = 'C:\Users\hp\OneDrive\Desktop\ae-gll\new_prod\Cephalopods';

    private array $extensions = ['avif', 'jpg', 'jpeg', 'png', 'webp'];

    public function handle(): int
    {
        return $this->runUpdate($this->option('dir') ?: $this->sourceDir, 'Cephalopods');
    }

    private function runUpdate(string $dir, string $categoryName): int
    {
        if (!is_dir($dir)) {
            $this->error("Directory not found: {$dir}");
            return self::FAILURE;
        }
        $category = Category::where('name', $categoryName)->first();
        if (!$category) {
            $this->error("Category \"{$categoryName}\" not found.");
            return self::FAILURE;
        }
        $products = Product::where('category_id', $category->id)
            ->where(function ($q) {
                $q->whereNull('image')->orWhere('image', '');
            })->get();
        $files = $this->getImageFiles($dir);
        $updated = $skipped = 0;
        foreach ($products as $product) {
            $match = $this->findMatchingFile($product->name, $files);
            if (!$match) {
                $this->warn("No image for: {$product->name}");
                $skipped++;
                continue;
            }
            $destDir = public_path('images/products/' . $product->slug);
            if (!File::isDirectory($destDir)) {
                File::makeDirectory($destDir, 0755, true, true);
            }
            $ext = pathinfo($match, PATHINFO_EXTENSION);
            $destName = 'main_' . time() . '_' . $product->id . '.' . $ext;
            $destPath = $destDir . DIRECTORY_SEPARATOR . $destName;
            if (!copy($match, $destPath)) {
                $this->error("Failed to copy: {$match}");
                continue;
            }
            $product->update(['image' => 'images/products/' . $product->slug . '/' . $destName]);
            $this->line("OK: {$product->name} ← " . basename($match));
            $updated++;
        }
        $this->info("Updated: {$updated}, No match: {$skipped}");
        return self::SUCCESS;
    }

    private function getImageFiles(string $dir): array
    {
        $out = [];
        foreach ($this->extensions as $ext) {
            foreach (File::glob($dir . DIRECTORY_SEPARATOR . '*.' . $ext) as $path) {
                $out[] = $path;
            }
        }
        return $out;
    }

    private function normalizeForMatch(string $name): string
    {
        $name = preg_replace('/\s*[\/\-]\s*/', ' ', $name);
        return strtolower(preg_replace('/\s+/', ' ', trim($name)));
    }

    private function findMatchingFile(string $productName, array $filePaths): ?string
    {
        $productNorm = $this->normalizeForMatch($productName);
        foreach ($filePaths as $path) {
            $base = pathinfo($path, PATHINFO_FILENAME);
            if ($this->normalizeForMatch($base) === $productNorm) {
                return $path;
            }
        }
        foreach ($filePaths as $path) {
            $base = pathinfo($path, PATHINFO_FILENAME);
            $baseNorm = $this->normalizeForMatch($base);
            if (str_contains($baseNorm, $productNorm) || str_contains($productNorm, $baseNorm)) {
                return $path;
            }
        }
        $productWords = array_filter(explode(' ', $productNorm), fn($w) => strlen($w) > 1);
        foreach ($filePaths as $path) {
            $base = pathinfo($path, PATHINFO_FILENAME);
            $baseNorm = $this->normalizeForMatch($base);
            $baseWords = array_filter(explode(' ', $baseNorm), fn($w) => strlen($w) > 1);
            if (count(array_intersect($productWords, $baseWords)) >= min(2, count($productWords), count($baseWords))) {
                return $path;
            }
        }
        foreach ($filePaths as $path) {
            $base = pathinfo($path, PATHINFO_FILENAME);
            if (str_replace(' ', '', $this->normalizeForMatch($base)) === str_replace(' ', '', $productNorm)) {
                return $path;
            }
        }
        return null;
    }
}
