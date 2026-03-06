<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SyncFreshWaterProductsCommand extends Command
{
    protected $signature = 'products:sync-fresh-water';

    protected $description = 'Move existing products to Fresh Water Fish, add missing with description only (no image)';

    private array $productNames = [
        'Helicopter Catfish / Boal',
        'Long Whiskered Catfish',
        'Oreochromis / Tilapia',
        'Dwarf Goonch',
        'Clown Knife Fish / Chital',
        'Rohu',
        'Baim',
        'Striped Snakehead Fish / Sole',
        'Orangefin Labeo / Kali Bosh',
        'Kangla',
        'Pabda',
        'Tank Goby / Baila',
        'Gangetic Mystus / Tengra',
        'Rita',
        'Spotted Snakehead / Taki',
        'Basha',
        'Star Baim',
        'Gulsha',
        'Silver Barb / Putti',
        'Freshwater Garfish / Kakila',
        'Lariya',
        'Katla',
        'Silver Carp',
        'Chanda',
        'Grass Carp',
        'Tara Sole',
        'Dhela',
        'Chapila',
        'Walking Catfish / Magur',
    ];

    public function handle(): int
    {
        $category = Category::where('name', 'Fresh Water Fish')->first();
        if (!$category) {
            $this->error('Category "Fresh Water Fish" not found.');
            return self::FAILURE;
        }

        $moved = 0;
        $added = 0;
        $unchanged = 0;

        foreach ($this->productNames as $name) {
            $name = trim($name);
            if ($name === '') continue;

            $existing = Product::whereRaw('LOWER(TRIM(name)) = ?', [strtolower($name)])->first();

            if ($existing) {
                if ($existing->category_id !== $category->id) {
                    $existing->update(['category_id' => $category->id]);
                    $this->line("Moved: {$name} → Fresh Water Fish");
                    $moved++;
                } else {
                    $unchanged++;
                }
                continue;
            }

            Product::create([
                'name' => $name,
                'slug' => $this->uniqueSlug($name),
                'description' => "Premium quality {$name}. Fresh water fish from Akhlaq Enterprises, processed to international standards.",
                'category_id' => $category->id,
                'specifications' => null,
                'image' => null,
                'gallery' => null,
            ]);
            $this->line("Added: {$name}");
            $added++;
        }

        $this->info("");
        $this->info("Moved to Fresh Water Fish: {$moved}, Added: {$added}, Already there: {$unchanged}");
        return self::SUCCESS;
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
