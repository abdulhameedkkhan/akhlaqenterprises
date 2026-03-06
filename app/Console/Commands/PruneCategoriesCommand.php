<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class PruneCategoriesCommand extends Command
{
    protected $signature = 'categories:prune';

    protected $description = 'Keep only the specified categories and delete all others (products cascade)';

    private array $keepNames = [
        'Fresh Water',
        'Sea Water',
        'Shrimps / Prawns',
        'Lobsters',
        'Shells',
        'Jellyfish',
        'Cephalopods',
    ];

    public function handle(): int
    {
        $keep = Category::whereIn('name', $this->keepNames)->get();
        $delete = Category::whereNotIn('name', $this->keepNames)->get();

        $deletedCount = 0;
        foreach ($delete as $cat) {
            $deletedCount++;
            $this->info("Deleting: {$cat->name} (id: {$cat->id}, products: " . $cat->products()->count() . ")");
            $cat->delete();
        }

        Cache::forget('all_categories');
        $this->info('');
        $this->info("Deleted {$deletedCount} categories. Kept: " . implode(', ', $this->keepNames));
        return self::SUCCESS;
    }
}
