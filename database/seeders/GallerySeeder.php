<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Processing Line',
                'image' => 'images/gallery/prod-1.jpg',
                'category' => 'Production',
            ],
            [
                'title' => 'Flash Freezing Unit',
                'image' => 'images/gallery/prod-2.jpg',
                'category' => 'Production',
            ],
            [
                'title' => 'Main Facility',
                'image' => 'images/gallery/comp-1.jpg',
                'category' => 'Company',
            ],
            [
                'title' => 'Global Seafood Expo',
                'image' => 'images/gallery/port-1.jpg',
                'category' => 'Portfolio',
            ],
            [
                'title' => 'Export Shipment',
                'image' => 'images/gallery/port-2.jpg',
                'category' => 'Portfolio',
            ],
            [
                'title' => 'Processing Line',
                'image' => 'images/gallery/1769953226_processing-line.webp',
                'category' => 'Production',
            ],
            [
                'title' => 'Processing Line',
                'image' => 'images/gallery/1769953260_processing-line.webp',
                'category' => 'Production',
            ],
            [
                'title' => 'Processing Line',
                'image' => 'images/gallery/1769953594_processing-line.jpg',
                'category' => 'Production',
            ],
        ];

        foreach ($galleries as $item) {
            Gallery::updateOrCreate(
                ['image' => $item['image']],
                $item
            );
        }
    }
}
