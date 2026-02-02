<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Shrimps',
            'Squids',
            'Cuttle Fish',
            'Fresh Water Fish',
            'Emperor Fish',
            'Grouper Fish',
            'King Fish',
            'Barracuda Fish',
            'Tuna Fish',
            'Black Pompfret',
            'Crabs',
            'Reef Cod (Daama)',
            'Ambrose Fish (Mahi Mahi)',
            'Lobster',
            'Top Shell',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}
