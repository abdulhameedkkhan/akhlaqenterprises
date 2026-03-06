<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class AssignProductsToCategoriesCommand extends Command
{
    protected $signature = 'products:assign-categories';

    protected $description = 'Move each product into the category it fits (for current 8 categories)';

    /** Product name (lowercase) => category slug/key */
    private function getProductToCategoryMap(): array
    {
        $map = [];

        $lists = [
            'Fresh Water Fish' => [
                'helicopter catfish', 'boal', 'long whiskered catfish', 'oreochromis', 'tilapia', 'dwarf goonch',
                'clown knife fish', 'chital', 'rohu', 'baim', 'striped snakehead', 'sole', 'orangefin labeo', 'kali bosh',
                'kangla', 'pabda', 'tank goby', 'baila', 'gangetic mystus', 'tengra', 'rita', 'spotted snakehead', 'taki',
                'basha', 'star baim', 'gulsha', 'silver barb', 'putti', 'freshwater garfish', 'kakila', 'lariya', 'katla',
                'silver carp', 'chanda', 'grass carp', 'tara sole', 'dhela', 'chapila', 'walking catfish', 'magur',
                'large baim', 'bag ayer', 'kanghi', 'ayer', 'cat fish', 'lizard fish', 'parrot fish', 'needle fish',
                'four finger threadfin', 'round sole', 'yellowfin bream', 'grey mullet', 'lady fish', 'bombay duck',
            ],
            'Sea Water Fish' => [
                'pomfret', 'king fish', 'sardine', 'mackerel', 'ribbon fish', 'threadfin bream', 'john snapper',
                'barracuda', 'reef cod', 'croaker', 'grouper', 'trevally', 'snapper', 'sillago', 'sea bream', 'shad',
                'sea bass', 'leather jacket', 'tuna', 'albacore', 'kawakawa', 'spanish mackerel', 'tongue sole',
                'stingray', 'cobia', 'scad', 'oil sardine', 'jhon snapper', 'brown stingray', 'mullet',
                'tiger tooth croaker', 'silver croaker', 'yellow croaker', 'chinese pomfret', 'silver pomfret',
                'black pomfret', 'trichiurus', 'sardinella', 'silver pomfret', 'black pompftet', 'skipjack',
                'bonita', 'yellowfin tuna', 'cod', 'grouper fish', 'emperor', 'black tip trevally', 'giant trevally',
                'brown spotted grouper', 'red grouper', 'greasy grouper',
            ],
            'Shrimps / Prawns' => [
                'shrimp', 'prawn', 'kiddi shrimp', 'indian white prawn', 'giant tiger prawn', 'flower shrimp',
                'giant freshwater shrimp', 'green tiger prawn', 'brown shrimp', 'white shrimp', 'flower tiger shrimp',
                'black tiger shrimp', 'metapenaeus', 'penaeus',
            ],
            'Lobsters' => [
                'lobster', 'slipper sand lobster', 'mud spiny lobster', 'spiny lobster', 'sand lobster', 'green lobster',
                'ibacus', 'panulirus',
            ],
            'Shells' => [
                'top shell', 'clam', 'mussel', 'razor clam', 'blood clam', 'hard clam', 'fan shell', 'baigai',
                'babylonia',
            ],
            'Jellyfish' => [
                'jellyfish', 'salted jellyfish', 'barrel jellyfish', 'flower jellyfish',
            ],
            'Cephalopods' => [
                'squid', 'cuttlefish', 'octopus', 'cuttle fish', 'indian squid', 'baby octopus',
            ],
            'Crabs' => [
                'crab', 'blue swimming crab', 'spotted crab', 'mud crab', 'portunus', 'scylla',
            ],
        ];

        foreach ($lists as $categoryName => $keywords) {
            foreach ($keywords as $kw) {
                $map[$kw] = $categoryName;
            }
        }

        return $map;
    }

    public function handle(): int
    {
        $categories = Category::all()->keyBy('name');
        if ($categories->isEmpty()) {
            $this->error('No categories found.');
            return self::FAILURE;
        }

        $this->info('Current categories: ' . $categories->keys()->implode(', '));

        $map = $this->getProductToCategoryMap();
        $products = Product::with('category')->get();
        $updated = 0;
        $unchanged = 0;
        $noMatch = [];

        foreach ($products as $product) {
            $name = strtolower($product->name);
            $targetCategoryName = null;

            foreach ($map as $keyword => $categoryName) {
                if (str_contains($name, $keyword) && $categories->has($categoryName)) {
                    $targetCategoryName = $categoryName;
                    break;
                }
            }

            if (!$targetCategoryName) {
                $noMatch[] = $product->name . ' (current: ' . ($product->category?->name ?? 'none') . ')';
                continue;
            }

            $target = $categories[$targetCategoryName];
            if ($product->category_id !== $target->id) {
                $product->update(['category_id' => $target->id]);
                $this->line("Moved: {$product->name} → {$target->name}");
                $updated++;
            } else {
                $unchanged++;
            }
        }

        Cache::forget('all_categories');
        $this->info("");
        $this->info("Updated: {$updated}, Unchanged: {$unchanged}");
        if (!empty($noMatch)) {
            $this->warn("No matching category (" . count($noMatch) . "): " . implode(', ', array_slice($noMatch, 0, 10)) . (count($noMatch) > 10 ? '...' : ''));
        }
        return self::SUCCESS;
    }
}
