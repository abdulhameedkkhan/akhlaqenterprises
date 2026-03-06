<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SyncShrimpsPrawnsCommand extends Command
{
    protected $signature = 'products:sync-shrimps-prawns';

    protected $description = 'Move/update shrimp & prawn products to Shrimps / Prawns; add missing with description, no image';

    private array $productNames = [
        'Kiddi Shrimp',
        'Indian White Prawn',
        'Giant Tiger Prawn',
        'Flower Shrimp',
        'Giant Freshwater Shrimp',
        'Green Tiger Prawn',
    ];

    public function handle(): int
    {
        $category = Category::where('name', 'Shrimps / Prawns')->first();
        if (!$category) {
            $this->error('Category "Shrimps / Prawns" not found.');
            return self::FAILURE;
        }

        $moved = 0;
        $added = 0;
        $updatedName = 0;
        $unchanged = 0;

        foreach ($this->productNames as $desiredName) {
            $desiredName = trim($desiredName);
            if ($desiredName === '') continue;

            $existing = Product::whereRaw('LOWER(TRIM(name)) = ?', [strtolower($desiredName)])->first();

            if ($existing) {
                $updates = [];
                if ($existing->name !== $desiredName) {
                    $updates['name'] = $desiredName;
                    $updatedName++;
                }
                if ($existing->category_id !== $category->id) {
                    $updates['category_id'] = $category->id;
                    $moved++;
                }
                if (!empty($updates)) {
                    $existing->update($updates);
                    $this->line("Updated: {$existing->name} → {$desiredName}, category → Shrimps / Prawns");
                } else {
                    $unchanged++;
                }
                continue;
            }

            $sameProduct = $this->findSameProduct($desiredName);
            if ($sameProduct) {
                $oldName = $sameProduct->name;
                $sameProduct->update([
                    'name' => $desiredName,
                    'category_id' => $category->id,
                ]);
                $this->line("Same product: \"{$oldName}\" → \"{$desiredName}\", moved to Shrimps / Prawns");
                $updatedName++;
                $moved++;
                continue;
            }

            Product::create([
                'name' => $desiredName,
                'slug' => $this->uniqueSlug($desiredName),
                'description' => "Premium quality {$desiredName}. From Akhlaq Enterprises, processed to international standards.",
                'category_id' => $category->id,
                'specifications' => null,
                'image' => null,
                'gallery' => null,
            ]);
            $this->line("Added: {$desiredName}");
            $added++;
        }

        $this->info("");
        $this->info("Moved/updated to Shrimps / Prawns: {$moved}, Name updated: {$updatedName}, Added: {$added}, Unchanged: {$unchanged}");
        return self::SUCCESS;
    }

    private function findSameProduct(string $desiredName): ?Product
    {
        $desiredLower = strtolower(trim($desiredName));
        $products = Product::all();

        foreach ($products as $p) {
            $base = trim(explode('(', $p->name)[0]);
            if (strtolower($base) === $desiredLower) {
                return $p;
            }
        }

        return null;
    }

    private function uniqueSlug(string $name): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $n = 0;
        while (Product::where('slug', $slug)->exists()) {
            $n++;
            $slug = $base . '-' . $n;
        }
        return $slug;
    }
}
