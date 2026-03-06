<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesProductsSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Fresh Water' => [
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
            ],
            'Sea Water' => [
                'Silver / White Pomfret',
                'Chinese Pomfret',
                'Black Pomfret',
                'King Fish',
                'Sardine',
                'Indian Mackerel',
                'Ribbon Fish',
                'Sea Kakila',
                'Threadfin Bream',
                'John Snapper',
                'Barracuda',
                'Reef Cod',
                'T.T. Croaker',
                'Silver Croaker',
                'Malabar Grouper',
                'Giant Trevally',
                'Malabar Blood Snapper',
                'Silver Sillago',
                'Red Sea Bream',
                'Toli Shad',
                'Yellow Croaker',
                'Sea Bass',
                'Leather Jacket',
                'Big Eye Tuna',
                'Kawakawa',
                'Long Tail Tuna',
                'Yellow Fin Tuna',
                'Albacore',
                'Shad',
                'Spotted Spanish Mackerel',
                'Tongue Sole',
                'Stingray Fish',
            ],
            'Shrimps / Prawns' => [
                'Kiddi Shrimp',
                'Indian White Prawn',
                'Giant Tiger Prawn',
                'Flower Shrimp',
                'Giant Freshwater Shrimp',
                'Green Tiger Prawn',
            ],
            'Lobsters' => [
                'Slipper Sand Lobster',
                'Mud Spiny Lobster',
                'Spiny Lobster',
            ],
            'Shells' => [
                'Top Shell',
                'Finger Razor Clam',
                'Asian Brown Mussel',
                'Blood Clam',
                'Hard Clam',
                'Fan Shell',
            ],
            'Jellyfish' => [
                'Salted Jellyfish',
                'Barrel Jellyfish',
                'Flower Jellyfish',
            ],
            'Cephalopods' => [
                'Indian Squid',
                'Cuttlefish',
                'Baby Octopus',
            ],
        ];

        $categoriesCreated = 0;
        $productsCreated = 0;
        $productsUpdated = 0;

        foreach ($data as $categoryName => $productNames) {
            $category = Category::firstOrCreate(
                ['name' => $categoryName],
                [
                    'slug' => $this->uniqueCategorySlug($categoryName),
                    'image' => null,
                ]
            );

            if ($category->wasRecentlyCreated) {
                $categoriesCreated++;
            }

            foreach ($productNames as $productName) {
                $productName = trim($productName);
                if ($productName === '') continue;

                $existing = Product::whereRaw('LOWER(TRIM(name)) = ?', [strtolower($productName)])->first();

                if ($existing) {
                    if ($existing->category_id !== $category->id) {
                        $existing->update(['category_id' => $category->id]);
                        $productsUpdated++;
                    }
                    continue;
                }

                Product::create([
                    'name' => $productName,
                    'slug' => $this->uniqueProductSlug($productName),
                    'description' => "Premium quality {$productName} from Akhlaq Enterprises. Processed and packed to international standards.",
                    'category_id' => $category->id,
                    'specifications' => null,
                    'image' => null,
                    'gallery' => null,
                ]);
                $productsCreated++;
            }
        }

        $this->command->info("Categories created: {$categoriesCreated}, Products created: {$productsCreated}, Products updated (category): {$productsUpdated}");
    }

    private function uniqueCategorySlug(string $name): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $n = 0;
        while (Category::where('slug', $slug)->exists()) {
            $n++;
            $slug = $base . '-' . $n;
        }
        return $slug;
    }

    private function uniqueProductSlug(string $name): string
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
