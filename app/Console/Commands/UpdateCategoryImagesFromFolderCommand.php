<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class UpdateCategoryImagesFromFolderCommand extends Command
{
    protected $signature = 'categories:update-images-from-folder {--dir= : Folder path containing category images}';

    protected $description = 'Copy category images from folder and assign by name (e.g. fresh-water-fish.jpg → Fresh Water, cephalopods.jpg → Cephalopods)';

    private string $sourceDir = 'C:\\Users\\hp\\OneDrive\\Desktop\\ae-gll\\categories';

    /**
     * Map: source filename (as in folder) => category name (exact DB name)
     */
    private array $fileToCategoryName = [
        'fresh-water-fish.jpg' => 'Fresh Water Fish',
        'sea water fish.jpg'   => 'Sea Water Fish',
        'shrimp-prawns.jpg'    => 'Shrimps / Prawns',
        'Loosters.png'         => 'Lobsters',
        'jellyfish.jpg'        => 'Jellyfish',
        'cephalopods.jpg'      => 'Cephalopods',
        'shell.jpg'            => 'Shells',
        'crab.jpg'             => 'Crabs',
    ];

    public function handle(): int
    {
        $dir = $this->option('dir') ?: $this->sourceDir;
        $dir = str_replace('/', '\\', $dir);

        if (!is_dir($dir)) {
            $this->error("Directory not found: {$dir}");
            return self::FAILURE;
        }

        $destDir = public_path('images/categories');
        if (!File::isDirectory($destDir)) {
            File::makeDirectory($destDir, 0755, true);
        }

        $updated = 0;
        foreach ($this->fileToCategoryName as $sourceFile => $categoryName) {
            $sourcePath = $dir . '\\' . $sourceFile;
            if (!file_exists($sourcePath)) {
                $this->warn("Skip (file not found): {$sourceFile}");
                continue;
            }

            $ext = pathinfo($sourceFile, PATHINFO_EXTENSION);
            $destFilename = \Illuminate\Support\Str::slug($categoryName) . '.' . $ext;
            $destPath = $destDir . '\\' . $destFilename;

            if (!copy($sourcePath, $destPath)) {
                $this->error("Failed to copy: {$sourceFile} → {$destFilename}");
                continue;
            }

            $category = Category::where('name', $categoryName)->first();
            if (!$category) {
                $this->warn("Category not found in DB: {$categoryName}");
                continue;
            }

            $imagePath = 'images/categories/' . $destFilename;
            $category->update(['image' => $imagePath]);
            $this->line("OK: {$categoryName} ← {$sourceFile} → {$imagePath}");
            $updated++;
        }

        if ($updated > 0) {
            Cache::forget('all_categories');
        }
        $this->info("Updated {$updated} category images.");
        return self::SUCCESS;
    }
}
