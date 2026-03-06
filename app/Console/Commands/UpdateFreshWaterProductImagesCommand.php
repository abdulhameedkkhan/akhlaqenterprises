<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateFreshWaterProductImagesCommand extends Command
{
    protected $signature = 'products:update-fresh-water-images {--dir= : Local folder path with product images} {--only= : Comma-separated product names to update (e.g. "Helicopter Catfish / Boal,Long Whiskered Catfish")}';

    protected $description = 'Set images for Fresh Water Fish products from local folder (images named by product name)';

    private string $sourceDir = 'C:\Users\hp\OneDrive\Desktop\ae-gll\new_prod\fresh water';

    private array $extensions = ['avif', 'jpg', 'jpeg', 'png', 'webp'];

    public function handle(): int
    {
        $dir = $this->option('dir') ?: $this->sourceDir;

        if (!is_dir($dir)) {
            $this->error("Directory not found: {$dir}");
            return self::FAILURE;
        }

        $category = Category::where('name', 'Fresh Water Fish')->first();
        if (!$category) {
            $this->error('Category "Fresh Water Fish" not found.');
            return self::FAILURE;
        }

        $onlyNames = $this->option('only');
        if ($onlyNames) {
            $names = array_map('trim', explode(',', $onlyNames));
            $products = Product::where('category_id', $category->id)
                ->whereIn('name', $names)
                ->get();
        } else {
            $products = Product::where('category_id', $category->id)
                ->where(function ($q) {
                    $q->whereNull('image')->orWhere('image', '');
                })
                ->get();
        }

        $files = $this->getImageFiles($dir);
        $updated = 0;
        $skipped = 0;

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

            $relativePath = 'images/products/' . $product->slug . '/' . $destName;
            $product->update(['image' => $relativePath]);
            $this->line("OK: {$product->name} ← " . basename($match));
            $updated++;
        }

        $this->info("");
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
        $name = preg_replace('/\s+/', ' ', trim($name));
        return strtolower($name);
    }

    private function findMatchingFile(string $productName, array $filePaths): ?string
    {
        $productNorm = $this->normalizeForMatch($productName);

        foreach ($filePaths as $path) {
            $base = pathinfo($path, PATHINFO_FILENAME);
            $baseNorm = $this->normalizeForMatch($base);
            if ($baseNorm === $productNorm) {
                return $path;
            }
        }

        $productWords = array_filter(explode(' ', $productNorm), fn($w) => strlen($w) > 1);
        foreach ($filePaths as $path) {
            $base = pathinfo($path, PATHINFO_FILENAME);
            $baseNorm = $this->normalizeForMatch($base);
            if (str_contains($baseNorm, $productNorm) || str_contains($productNorm, $baseNorm)) {
                return $path;
            }
            $baseWords = array_filter(explode(' ', $baseNorm), fn($w) => strlen($w) > 1);
            $common = array_intersect($productWords, $baseWords);
            if (count($common) >= min(2, count($productWords), count($baseWords))) {
                return $path;
            }
        }

        foreach ($filePaths as $path) {
            $base = pathinfo($path, PATHINFO_FILENAME);
            $baseNorm = $this->normalizeForMatch($base);
            if (str_replace(' ', '', $baseNorm) === str_replace(' ', '', $productNorm)) {
                return $path;
            }
        }

        $typos = [
            'silver barb / putti' => 'silver burb',
            'grass carp' => 'grass',
        ];
        foreach ($typos as $product => $fileLike) {
            if ($productNorm === $product) {
                foreach ($filePaths as $path) {
                    $base = pathinfo($path, PATHINFO_FILENAME);
                    if (str_contains(strtolower($base), $fileLike)) {
                        return $path;
                    }
                }
            }
        }

        if ($productNorm === 'helicopter catfish boal' || $productNorm === 'helicopter catfish  boal') {
            foreach ($filePaths as $path) {
                $base = pathinfo($path, PATHINFO_FILENAME);
                $b = $this->normalizeForMatch($base);
                if ($b === 'boal' || str_contains($b, 'helicopter') && str_contains($b, 'boal')) {
                    return $path;
                }
            }
        }

        if ($productNorm === 'long whiskered catfish') {
            foreach ($filePaths as $path) {
                $base = pathinfo($path, PATHINFO_FILENAME);
                $b = $this->normalizeForMatch($base);
                if ($b === $productNorm || str_contains($b, 'long') && str_contains($b, 'whiskered')) {
                    return $path;
                }
            }
        }

        return null;
    }
}
