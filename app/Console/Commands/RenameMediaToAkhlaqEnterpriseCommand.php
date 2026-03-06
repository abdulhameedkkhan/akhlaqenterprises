<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RenameMediaToAkhlaqEnterpriseCommand extends Command
{
    protected $signature = 'media:rename-to-akhlaq-enterprise {--dry-run : List changes without renaming}';

    protected $description = 'Rename all existing images and videos to start with akhlaq-enterprise- and update DB/views';

    private string $prefix = 'akhlaq-enterprise';

    /** @var array<string, string> old path (relative to public) => new path */
    private array $renamed = [];

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');
        $public = public_path();

        $dirs = [
            'images' => $public . '/images',
            'videos' => $public . '/videos',
        ];

        foreach ($dirs as $label => $dir) {
            if (!File::isDirectory($dir)) {
                continue;
            }
            $this->processDirectory($dir, $label === 'images' ? 'images' : 'videos');
        }

        if (empty($this->renamed)) {
            $this->info('No files needed renaming (all already prefixed or no files found).');
            $this->updateBladeVideoPaths($dryRun);
            return self::SUCCESS;
        }

        if ($dryRun) {
            $this->info('Dry run – would rename ' . count($this->renamed) . ' file(s):');
            foreach ($this->renamed as $old => $new) {
                $this->line("  {$old} → {$new}");
            }
            $this->info('Run without --dry-run to apply.');
            return self::SUCCESS;
        }

        foreach ($this->renamed as $oldRel => $newRel) {
            $oldPath = $public . '/' . $oldRel;
            $newPath = $public . '/' . $newRel;
            if (File::exists($oldPath)) {
                File::move($oldPath, $newPath);
                $this->line("Renamed: {$oldRel} → {$newRel}");
            }
        }

        $this->updateDatabase();
        $this->updateBladeVideoPaths(false);
        $this->updateViewPathReferences();
        $this->info('Done. Renamed ' . count($this->renamed) . ' file(s) and updated database/views.');
        return self::SUCCESS;
    }

    private function updateViewPathReferences(): void
    {
        $viewsPath = resource_path('views');
        $files = File::allFiles($viewsPath);
        foreach ($files as $file) {
            if ($file->getExtension() !== 'blade.php' && $file->getExtension() !== 'php') {
                continue;
            }
            $path = $file->getPathname();
            $content = File::get($path);
            $original = $content;
            foreach ($this->renamed as $old => $new) {
                $content = str_replace($old, $new, $content);
            }
            if ($content !== $original) {
                File::put($path, $content);
                $this->line('Updated view: ' . str_replace($viewsPath . DIRECTORY_SEPARATOR, '', $path));
            }
        }
    }

    private function processDirectory(string $dir, string $baseRel): void
    {
        $items = File::allFiles($dir);
        $basePath = public_path();
        $featuredVideoNames = ['featured-bg.mp4', '_featured-bg.mp4', 'akhlaqenterprises_featured-bg.mp4'];
        foreach ($items as $file) {
            $path = $file->getPathname();
            $basename = $file->getFilename();
            if (str_starts_with($basename, $this->prefix . '-')) {
                continue;
            }
            $rel = str_replace([$basePath, '\\'], ['', '/'], $path);
            $rel = trim($rel, '/');
            $dirPart = dirname($rel);
            if ($baseRel === 'videos' && in_array(strtolower($basename), array_map('strtolower', $featuredVideoNames), true)) {
                $newBasename = $this->prefix . '-featured-bg.mp4';
            } else {
                $newBasename = $this->prefix . '-' . $basename;
            }
            $newRel = ($dirPart === '.' ? $baseRel : $dirPart) . '/' . $newBasename;
            $this->renamed[$rel] = $newRel;
        }
    }

    private function updateDatabase(): void
    {
        $replacements = $this->renamed;

        Product::chunk(100, function ($products) use ($replacements) {
            foreach ($products as $product) {
                $changed = false;
                if ($product->image && isset($replacements[$product->image])) {
                    $product->image = $replacements[$product->image];
                    $changed = true;
                }
                if ($product->gallery && is_array($product->gallery)) {
                    $newGallery = [];
                    foreach ($product->gallery as $path) {
                        $newGallery[] = $replacements[$path] ?? $path;
                    }
                    if ($newGallery !== $product->gallery) {
                        $product->gallery = $newGallery;
                        $changed = true;
                    }
                }
                if ($changed) {
                    $product->save();
                }
            }
        });

        Gallery::whereNotNull('image')->get()->each(function (Gallery $item) use ($replacements) {
            if (isset($replacements[$item->image])) {
                $item->image = $replacements[$item->image];
                $item->save();
            }
        });

        Category::whereNotNull('image')->get()->each(function (Category $cat) use ($replacements) {
            if (isset($replacements[$cat->image])) {
                $cat->image = $replacements[$cat->image];
                $cat->save();
            }
        });
    }

    private function updateBladeVideoPaths(bool $dryRun): void
    {
        $views = [
            resource_path('views/home.blade.php') => [
                'videos/akhlaqenterprises_featured-bg.mp4' => 'videos/akhlaq-enterprise-featured-bg.mp4',
                'videos/featured-bg.mp4' => 'videos/akhlaq-enterprise-featured-bg.mp4',
                'videos/_featured-bg.mp4' => 'videos/akhlaq-enterprise-featured-bg.mp4',
            ],
            resource_path('views/products/index.blade.php') => [
                'videos/products-bg.mp4' => 'videos/akhlaq-enterprise-products-bg.mp4',
            ],
        ];

        foreach ($views as $path => $pairs) {
            if (!File::exists($path)) {
                continue;
            }
            $content = File::get($path);
            foreach ($pairs as $old => $new) {
                if (str_contains($content, $old)) {
                    if (!$dryRun) {
                        $content = str_replace($old, $new, $content);
                        File::put($path, $content);
                        $this->line("Updated blade: " . basename($path) . " ({$old} → {$new})");
                    } else {
                        $this->line("Would update blade: " . basename($path) . " ({$old} → {$new})");
                    }
                }
            }
        }
    }
}
