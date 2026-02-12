<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoProductSeeder extends Seeder
{
    /**
     * Seed exactly 10 demo products.
     */
    public function run(): void
    {
        $demos = [
            [
                'name' => 'Japanese Threadfin Bream',
                'category' => 'Fresh Water Fish',
                'scientific' => 'Nemipterus Japonicus',
            ],
            [
                'name' => 'Silver Pomfret',
                'category' => 'Fresh Water Fish',
                'scientific' => 'Pampus sp',
            ],
            [
                'name' => 'Black Tiger Shrimp',
                'category' => 'Shrimps',
                'scientific' => 'Penaeus monodon',
            ],
            [
                'name' => 'Yellowfin Tuna',
                'category' => 'Tuna Fish',
                'scientific' => 'Thunnus albacares',
            ],
            [
                'name' => 'Blue Swimming Crab',
                'category' => 'Crabs',
                'scientific' => 'Portunus pelagicus',
            ],
            [
                'name' => 'Squid',
                'category' => 'Cephalopods',
                'scientific' => 'Loliginidae',
            ],
            [
                'name' => 'Spanish Mackerel',
                'category' => 'King Fish',
                'scientific' => 'Scomberomorus spp',
            ],
            [
                'name' => 'Brown Spotted Grouper',
                'category' => 'Grouper Fish',
                'scientific' => 'Epinephelus chlorostigma',
            ],
            [
                'name' => 'Black Pomfret',
                'category' => 'Black Pompfret',
                'scientific' => 'Parastromateus niger',
            ],
            [
                'name' => 'Cuttle Fish',
                'category' => 'Cuttle Fish',
                'scientific' => 'Sepiida',
            ],
        ];

        foreach ($demos as $item) {
            $category = Category::firstOrCreate(
                ['name' => $item['category']],
                [
                    'slug' => Str::slug($item['category']),
                    'image' => 'images/categories/' . Str::slug($item['category']) . '.jpg',
                ]
            );

            $slug = Str::slug($item['name']);
            $gallery = [
                "images/products/{$slug}/1.jpg",
                "images/products/{$slug}/2.jpg",
                "images/products/{$slug}/3.jpg",
            ];

            Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $item['name'],
                    'category_id' => $category->id,
                    'description' => "Premium quality {$item['name']} sourced from the best harvesting grounds. Fresh, frozen, and processed under strict quality standards for global export.",
                    'image' => $this->getProductImage($slug, $item['category']),
                    'gallery' => $gallery,
                    'specifications' => [
                        'Scientific Name' => $item['scientific'],
                        'Standard' => 'Export Quality / A Grade',
                        'Freezing' => 'IQF / Block Frozen',
                        'Packing' => '10kg / 20kg per Master Carton',
                        'Origin' => 'Pakistan',
                    ],
                ]
            );
        }
    }

    private function getProductImage(string $slug, string $category): string
    {
        $directory = public_path('images/products/' . $slug);
        if (is_dir($directory)) {
            $files = glob($directory . '/main*');
            if (!empty($files)) {
                $filename = basename($files[0]);
                return 'images/products/' . $slug . '/' . $filename;
            }
        }

        $placeholders = [
            'Fresh Water Fish' => 'https://images.unsplash.com/photo-1524704654690-b56c05c78a00?auto=format&fit=crop&q=80&w=800',
            'Emperor Fish' => 'https://images.unsplash.com/photo-1534123231700-1c05d064dd7c?auto=format&fit=crop&q=80&w=800',
            'Grouper Fish' => 'https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&q=80&w=800',
            'King Fish' => 'https://images.unsplash.com/photo-1544621530-999335694851?auto=format&fit=crop&q=80&w=800',
            'Barracuda Fish' => 'https://images.unsplash.com/photo-1510257321689-5f2840d2b453?auto=format&fit=crop&q=80&w=800',
            'Tuna Fish' => 'https://images.unsplash.com/photo-1522204523234-8729aa6e3d5f?auto=format&fit=crop&q=80&w=800',
            'Crabs' => 'https://images.unsplash.com/photo-1550504620-13e6a495679c?auto=format&fit=crop&q=80&w=800',
            'Cephalopods' => 'https://images.unsplash.com/photo-1545671913-b89ac1b4ac10?auto=format&fit=crop&q=80&w=800',
            'Shrimps' => 'https://images.unsplash.com/photo-1535141192574-5d4897c12636?auto=format&fit=crop&q=80&w=800',
            'Black Pompfret' => 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?auto=format&fit=crop&q=80&w=800',
            'Cuttle Fish' => 'https://images.unsplash.com/photo-1574781330852-dc92d831b0b2?auto=format&fit=crop&q=80&w=800',
        ];

        return $placeholders[$category] ?? 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?auto=format&fit=crop&q=80&w=800';
    }
}
