<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportProductsFromExcel extends Command
{
    protected $signature = 'products:import-excel {file : Path to the Excel (.xlsx) or CSV file}';

    protected $description = 'Import categories and products from Excel/CSV. Skips existing products. New products get description and image null.';

    public function handle(): int
    {
        $path = $this->argument('file');

        if (!is_file($path)) {
            $this->error("File not found: {$path}");
            $this->line('');
            $this->line('If you have an Excel (.xlsx) file:');
            $this->line('  1. Open it in Excel, then File → Save As → CSV (Comma delimited) (*.csv)');
            $this->line('  2. Run: php artisan products:import-excel "path/to/your-file.csv"');
            return self::FAILURE;
        }

        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        $rows = [];

        if ($ext === 'csv') {
            $rows = $this->readCsv($path);
        } elseif ($ext === 'xlsx' || $ext === 'xls') {
            if (!class_exists('ZipArchive')) {
                $this->error('Excel support requires PHP ext-zip. Save the sheet as CSV and run: php artisan products:import-excel "path/to/file.csv"');
                return self::FAILURE;
            }
            try {
                $spreadsheet = IOFactory::load($path);
                $rows = $spreadsheet->getActiveSheet()->toArray();
            } catch (\Throwable $e) {
                $this->error('Could not load Excel: ' . $e->getMessage());
                return self::FAILURE;
            }
        } else {
            $this->error('Supported formats: .csv, .xlsx, .xls');
            return self::FAILURE;
        }

        if (empty($rows)) {
            $this->warn('Sheet is empty.');
            return self::SUCCESS;
        }

        $headers = array_map(function ($h) {
            return trim(strtolower((string) $h));
        }, (array) $rows[0]);
        $categoryCol = $this->findColumnIndex($headers, ['category', 'categories', 'category name']);
        $productCol = $this->findColumnIndex($headers, ['product', 'products', 'product name', 'name', 'item']);

        if ($categoryCol === null || $productCol === null) {
            $this->error('Could not find "Category" and "Product" columns. Headers: ' . implode(', ', $rows[0]));
            return self::FAILURE;
        }

        $existingCategories = Category::all()->mapWithKeys(fn ($c) => [strtolower(trim($c->name)) => $c->id])->all();
        $existingProductNames = Product::all()->mapWithKeys(fn ($p) => [strtolower(trim($p->name)) => true])->all();

        $categoriesCreated = 0;
        $productsCreated = 0;
        $skipped = 0;

        foreach (array_slice($rows, 1) as $row) {
            $catName = isset($row[$categoryCol]) ? trim((string) $row[$categoryCol]) : '';
            $productName = isset($row[$productCol]) ? trim((string) $row[$productCol]) : '';

            if ($catName === '' || $productName === '') {
                continue;
            }

            $catKey = strtolower($catName);
            $productKey = strtolower($productName);

            if (isset($existingProductNames[$productKey])) {
                $skipped++;
                continue;
            }

            if (!isset($existingCategories[$catKey])) {
                $category = Category::create([
                    'name' => $catName,
                    'slug' => $this->uniqueSlug(Category::class, Str::slug($catName)),
                    'image' => null,
                ]);
                $existingCategories[$catKey] = $category->id;
                $categoriesCreated++;
            }

            $categoryId = $existingCategories[$catKey];
            $description = "Premium quality {$productName} from Akhlaq Enterprises. Processed and packed to international standards.";

            Product::create([
                'name' => $productName,
                'slug' => $this->uniqueSlug(Product::class, Str::slug($productName)),
                'description' => $description,
                'category_id' => $categoryId,
                'specifications' => null,
                'image' => null,
                'gallery' => null,
            ]);
            $existingProductNames[$productKey] = true;
            $productsCreated++;
        }

        $this->info("Done. Categories created: {$categoriesCreated}, Products created: {$productsCreated}, Skipped (already exist): {$skipped}");
        return self::SUCCESS;
    }

    private function readCsv(string $path): array
    {
        $rows = [];
        $fp = fopen($path, 'rb');
        if (!$fp) {
            return [];
        }
        while (($row = fgetcsv($fp)) !== false) {
            $rows[] = $row;
        }
        fclose($fp);
        return $rows;
    }

    private function findColumnIndex(array $headers, array $names): ?int
    {
        foreach ($names as $name) {
            $idx = array_search($name, $headers, true);
            if ($idx !== false) {
                return (int) $idx;
            }
        }
        return null;
    }

    private function uniqueSlug(string $model, string $base): string
    {
        $slug = $base;
        $n = 0;
        while ($model::where('slug', $slug)->exists()) {
            $n++;
            $slug = $base . '-' . $n;
        }
        return $slug;
    }
}
