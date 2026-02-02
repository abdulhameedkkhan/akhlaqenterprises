<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Production
            ['title' => 'Processing Line', 'category' => 'Production', 'description' => 'Modern HACCP certified processing line.', 'image' => 'images/gallery/prod-1.jpg'],
            ['title' => 'Flash Freezing Unit', 'category' => 'Production', 'description' => 'Advanced blast freezing at -40°C.', 'image' => 'images/gallery/prod-2.jpg'],
            ['title' => 'Quality Inspection', 'category' => 'Production', 'description' => 'Stringent quality checks by experts.', 'image' => 'images/gallery/prod-3.jpg'],
            ['title' => 'Packaging Area', 'category' => 'Production', 'description' => 'Hygienic packaging for global export.', 'image' => 'images/gallery/prod-4.jpg'],

            // Company
            ['title' => 'Main Facility', 'category' => 'Company', 'description' => 'Our state-of-the-art facility in Karachi.', 'image' => 'images/gallery/comp-1.jpg'],
            ['title' => 'The Team', 'category' => 'Company', 'description' => 'Our dedicated team of professionals.', 'image' => 'images/gallery/comp-2.jpg'],
            ['title' => 'Office Internal', 'category' => 'Company', 'description' => 'Headquarters office interior.', 'image' => 'images/gallery/comp-3.jpg'],

            // Portfolio / Events
            ['title' => 'Global Seafood Expo', 'category' => 'Portfolio', 'description' => 'Participating in international trade fairs.', 'image' => 'images/gallery/port-1.jpg'],
            ['title' => 'Export Shipment', 'category' => 'Portfolio', 'description' => 'Container loading for international clients.', 'image' => 'images/gallery/port-2.jpg'],
        ];

        foreach ($data as $item) {
            \App\Models\Gallery::create($item);
        }
    }
}
