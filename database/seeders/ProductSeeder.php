<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // By removing truncate, we can safely run this seeder multiple times
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Product::truncate();
        // Category::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            'Fresh Water Fish' => [
                'Japanese Threadfin Bream (Nemipterus Japonicus)',
                'Sole Fish (Cynoglossus spp)',
                'Tiger Tooth Croaker (Otolithes ruber)',
                'Silver Croaker (Johnius carutta)',
                'Yellow Croaker (Micropogonias furnieri)',
                'Leather Jacket (Oligoplites saurus)',
                'Chinese Pomfret (Pampus chinensis)',
                'Silver Pomfret (Pampus sp)',
                'Cat Fish (Arius maculatus)',
                'Ribbon Fish (Trichiurus lepturus)',
                'Brown Stingray (Himantura walga)',
                'Oil Sardine (Sardinella longiceps)',
                'Lady Fish (Sillago soringa)',
                'Grey Mullet (Valamugil seheli)',
                'Yellowfin Bream',
                'Round Sole',
                'Lizard Fish',
                'Parrot Fish',
                'Four Finger Threadfin',
                'Needle Fish',
                'Tongue Sole',
                'Jhon Snapper',
                'Bombay Duck',
                'Ayer',
                'Boal',
                'Chital',
                'Large Baim',
                'Bag Ayer',
                'Kanghi',
            ],
            'Black Pompfret' => [
                'Black Pomfret (Parastromateus niger)',
            ],
            'Tuna Fish' => [
                'Yellowfin Tuna (Thunnus albacares)',
                'Skipjack Tuna (Katsuwonus pelamis)',
                'Bonita Tuna (Euthynnus affinis)',
            ],
            'Cuttle Fish' => [
                'Cuttle Fish',
            ],
            'Cephalopods' => [
                'Squid',
                'Octopus',
            ],
            'Shrimps' => [
                'Brown Shrimp (Metapenaeus monoceros)',
                'White Shrimp (Penaeus indicus)',
                'Flower Tiger Shrimp (Penaeus semisulcatus)',
                'Black Tiger Shrimp (Penaeus monodon)',
            ],
            'Lobster' => [
                'Sand Lobster (Ibacus peronii)',
                'Green Lobster (Panulirus polyphagus)',
            ],
            'Crabs' => [
                'Blue Swimming Crab (Portunus pelagicus)',
                '3 Spotted Crab (Portunus sanguinolentus)',
                'Mud Crab (Scylla serrata)',
            ],
            'Top Shell' => [
                'Baigai / Top Shell (Babylonia spirata)',
            ],
            'King Fish' => [
                'Spanish Mackerel',
                'Indian Mackerel',
                'Hard Tail Mackerel',
                'Cobia Fish',
                'Green Tail Scad',
            ],
            'Emperor Fish' => [
                'Black Tip Trevally',
                'Emperor',
                'Giant Trevally',
            ],
            'Grouper Fish' => [
                'Brown Spotted Grouper',
                'Red Grouper Banded',
                'Greasy Grouper',
            ],
            'Barracuda Fish' => [
                'Barracuda',
            ],
        ];

        foreach ($data as $categoryName => $productList) {
            $category = Category::firstOrCreate(
                ['name' => $categoryName],
                [
                    'slug' => Str::slug($categoryName),
                    'image' => 'images/categories/' . Str::slug($categoryName) . '.jpg',
                ]
            );

            foreach ($productList as $productName) {
                $slug = Str::slug($productName);
                
                // Try to find existing product first
                $existingProduct = Product::where('name', $productName)->first();

                // Determine image
                $image = $this->getProductImage($slug, $categoryName);
                
                // If getProductImage returned a placeholder (unsplash), but database has a custom image, keep DB one
                if (Str::contains($image, 'unsplash.com') && $existingProduct && $existingProduct->image) {
                    if (!Str::contains($existingProduct->image, 'unsplash.com') && !Str::endsWith($existingProduct->image, 'placeholder.jpg')) {
                        $image = $existingProduct->image;
                    }
                }

                // Determine gallery
                $gallery = [
                    "images/products/{$slug}/1.jpg",
                    "images/products/{$slug}/2.jpg",
                    "images/products/{$slug}/3.jpg",
                ];
                if ($existingProduct && !empty($existingProduct->gallery)) {
                    // If gallery has items that aren't generic 1.jpg/2.jpg, keep it
                    // Or simply keep it if it's already set by the user
                    $gallery = $existingProduct->gallery;
                }

                Product::updateOrCreate(
                    ['name' => $productName],
                    [
                        'slug' => $slug,
                        'category_id' => $category->id,
                        'description' => $existingProduct->description ?? "Premium quality {$productName} sourced from the best harvesting grounds. Fresh, frozen, and processed under strict quality standards for global export.",
                        'image' => $image,
                        'gallery' => $gallery,
                        'specifications' => $existingProduct->specifications ?? [
                            'Scientific Name' => $this->getScientificName($productName),
                            'Standard' => 'Export Quality / A Grade',
                            'Freezing' => 'IQF / Block Frozen',
                            'Packing' => '10kg / 20kg per Master Carton',
                            'Origin' => 'Pakistan',
                        ],
                    ]
                );
            }
        }
    }

    private function getScientificName($name)
    {
        preg_match('/\((.*?)\)/', $name, $matches);
        return $matches[1] ?? 'N/A';
    }

    private function getProductImage($slug, $category)
    {
        // 1. Check if the directory exists and find the BEST "main" file
        $directory = public_path('images/products/' . $slug);
        if (File::isDirectory($directory)) {
            $files = File::files($directory);
            $bestFile = null;
            
            foreach ($files as $file) {
                $filename = $file->getFilename();
                if (Str::startsWith($filename, 'main')) {
                    // Prefer longer filenames (usually have timestamps like main_123.jpg) 
                    // over simple "main.jpg"
                    if (!$bestFile || strlen($filename) > strlen($bestFile)) {
                        $bestFile = $filename;
                    }
                }
            }
            
            if ($bestFile) {
                return 'images/products/' . $slug . '/' . $bestFile;
            }
        }

        // 2. Professional fish placeholders from Unsplash for new products
        $placeholders = [
            'Fresh Water Fish' => 'https://images.unsplash.com/photo-1524704654690-b56c05c78a00?auto=format&fit=crop&q=80&w=800',
            'Emperor Fish' => 'https://images.unsplash.com/photo-1534123231700-1c05d064dd7c?auto=format&fit=crop&q=80&w=800',
            'Grouper Fish' => 'https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&q=80&w=800',
            'King Fish' => 'https://images.unsplash.com/photo-1544621530-999335694851?auto=format&fit=crop&q=80&w=800',
            'Barracuda Fish' => 'https://images.unsplash.com/photo-1510257321689-5f2840d2b453?auto=format&fit=crop&q=80&w=800',
            'Tuna Fish' => 'https://images.unsplash.com/photo-1522204523234-8729aa6e3d5f?auto=format&fit=crop&q=80&w=800',
            'Crabs' => 'https://images.unsplash.com/photo-1550504620-13e6a495679c?auto=format&fit=crop&q=80&w=800',
            'Cephalopods' => 'https://images.unsplash.com/photo-1545671913-b89ac1b4ac10?auto=format&fit=crop&q=80&w=800',
        ];

        return $placeholders[$category] ?? 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?auto=format&fit=crop&q=80&w=800';
    }
}
