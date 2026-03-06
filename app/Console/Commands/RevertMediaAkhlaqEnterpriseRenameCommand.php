<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RevertMediaAkhlaqEnterpriseRenameCommand extends Command
{
    protected $signature = 'media:revert-akhlaq-enterprise-rename {--dry-run : List changes without applying}';

    protected $description = 'Revert media rename: remove akhlaq-enterprise- prefix from filenames and update DB/views so pics show again';

    private string $prefix = 'akhlaq-enterprise-';

    /** @var array<string, string> current path (prefixed) => path without prefix */
    private array $revert = [];

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');
        $public = public_path();

        foreach (['images', 'videos'] as $dirName) {
            $dir = $public . '/' . $dirName;
            if (!File::isDirectory($dir)) {
                continue;
            }
            $this->collectPrefixedFiles($dir, $dirName);
        }

        if (empty($this->revert)) {
            $this->info('No prefixed files found to revert.');
            return self::SUCCESS;
        }

        if ($dryRun) {
            $this->info('Dry run – would revert ' . count($this->revert) . ' file(s):');
            foreach ($this->revert as $current => $old) {
                $this->line("  {$current} → {$old}");
            }
            return self::SUCCESS;
        }

        foreach ($this->revert as $currentRel => $oldRel) {
            $currentPath = $public . '/' . $currentRel;
            $oldPath = $public . '/' . $oldRel;
            if (File::exists($currentPath)) {
                File::move($currentPath, $oldPath);
                $this->line("Reverted: {$currentRel} → {$oldRel}");
            }
        }

        $this->revertDatabase();
        $this->revertViewPaths();
        $this->revertVideoBladePaths();
        $this->info('Done. Reverted ' . count($this->revert) . ' file(s) and updated database/views.');
        return self::SUCCESS;
    }

    private function collectPrefixedFiles(string $dir, string $baseRel): void
    {
        $items = File::allFiles($dir);
        $basePath = public_path();
        $featuredCanonical = $this->prefix . 'featured-bg.mp4';
        foreach ($items as $file) {
            $path = $file->getPathname();
            $basename = $file->getFilename();
            if (!str_starts_with($basename, $this->prefix)) {
                continue;
            }
            $currentRel = str_replace([$basePath, '\\'], ['', '/'], $path);
            $currentRel = trim($currentRel, '/');
            $newBasename = substr($basename, strlen($this->prefix));
            if ($newBasename === '') {
                continue;
            }
            $dirPart = dirname($currentRel);
            $oldRel = ($dirPart === '.' ? $baseRel : $dirPart) . '/' . $newBasename;
            $this->revert[$currentRel] = $oldRel;
        }
    }

    private function revertDatabase(): void
    {
        $revert = $this->revert;

        Product::chunk(100, function ($products) use ($revert) {
            foreach ($products as $product) {
                $changed = false;
                if ($product->image && isset($revert[$product->image])) {
                    $product->image = $revert[$product->image];
                    $changed = true;
                }
                if ($product->gallery && is_array($product->gallery)) {
                    $newGallery = [];
                    foreach ($product->gallery as $path) {
                        $newGallery[] = $revert[$path] ?? $path;
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

        Gallery::whereNotNull('image')->get()->each(function (Gallery $item) use ($revert) {
            if (isset($revert[$item->image])) {
                $item->image = $revert[$item->image];
                $item->save();
            }
        });

        Category::whereNotNull('image')->get()->each(function (Category $cat) use ($revert) {
            if (isset($revert[$cat->image])) {
                $cat->image = $revert[$cat->image];
                $cat->save();
            }
        });
    }

    private function revertViewPaths(): void
    {
        $viewsPath = resource_path('views');
        $files = File::allFiles($viewsPath);
        foreach ($files as $file) {
            if (!in_array($file->getExtension(), ['blade.php', 'php'], true)) {
                continue;
            }
            $path = $file->getPathname();
            $content = File::get($path);
            $original = $content;
            foreach ($this->revert as $current => $old) {
                $content = str_replace($current, $old, $content);
            }
            if ($content !== $original) {
                File::put($path, $content);
                $this->line('Updated view: ' . str_replace($viewsPath . DIRECTORY_SEPARATOR, '', $path));
            }
        }
    }

    private function revertVideoBladePaths(): void
    {
        $pairs = [
            resource_path('views/home.blade.php') => [
                'videos/akhlaq-enterprise-featured-bg.mp4' => 'videos/featured-bg.mp4',
            ],
            resource_path('views/products/index.blade.php') => [
                'videos/akhlaq-enterprise-products-bg.mp4' => 'videos/products-bg.mp4',
            ],
        ];
        foreach ($pairs as $path => $replacements) {
            if (!File::exists($path)) {
                continue;
            }
            $content = File::get($path);
            foreach ($replacements as $from => $to) {
                $content = str_replace($from, $to, $content);
            }
            File::put($path, $content);
        }
    }
}
