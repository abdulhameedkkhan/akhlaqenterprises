<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ContactViewerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'contact@akhlaq.com'],
            [
                'name' => 'Manager | CEO',
                'password' => Hash::make('contact123'),
                'role' => 'contact_viewer',
            ]
        );
    }
}
