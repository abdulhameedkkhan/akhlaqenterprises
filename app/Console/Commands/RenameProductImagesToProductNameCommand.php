<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RenameProductImagesToProductNameCommand extends Command
{
    protected $signature = 'products:rename-images-to-product-name {--dry-run : List changes without renaming}';

    protected $description = 'Rename each product main image to akhlaq-enterprise-{Product Name}.{ext} and update DB';

    private string $prefix = 'akhlaq-enterprise';

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');
        $products = Product::whereNotNull('image')
            ->where('image', 'not like', 'http%')
            ->get();

        $updated = 0;
        foreach ($products as $product) {
            $currentPath = public_path($product->image);
            if (!File::exists($currentPath)) {
                $this->warn("Skip (file not found): {$product->name} => {$product->image}");
                continue;
            }

            $ext = pathinfo($product->image, PATHINFO_EXTENSION);
            $safeName = $this->sanitizeFilename($product->name);
            $newBasename = $this->prefix . '-' . $safeName . '.' . $ext;

            $dir = dirname($product->image);
            $newRelPath = $dir . '/' . $newBasename;
            $newFullPath = public_path($newRelPath);

            if ($product->image === $newRelPath) {
                continue;
            }

            if (File::exists($newFullPath) && $newFullPath !== $currentPath) {
                $this->warn("Skip (target exists): {$product->name} => {$newBasename}");
                continue;
            }

            if ($dryRun) {
                $this->line("Would rename: {$product->image} → {$newRelPath}");
                $updated++;
                continue;
            }

            File::move($currentPath, $newFullPath);
            $product->update(['image' => $newRelPath]);
            $this->line("OK: {$product->name} → {$newBasename}");
            $updated++;
        }

        $this->info($dryRun ? "Dry run: would update {$updated} product image(s)." : "Done. Renamed {$updated} product image(s).");
        return self::SUCCESS;
    }

    private function sanitizeFilename(string $name): string
    {
        $name = str_replace(['\\', '/', ':', '*', '?', '"', '<', '>', '|'], '-', $name);
        $name = preg_replace('/-+/', '-', $name);
        return trim($name, " \t\n\r\0\x0B-");
    }
}
