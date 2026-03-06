<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class UpdateProductDescriptionsCommand extends Command
{
    protected $signature = 'products:update-descriptions';

    protected $description = 'Update all product descriptions to be unique and product-specific (category-based wording)';

    public function handle(): int
    {
        $products = Product::with('category')->get();
        if ($products->isEmpty()) {
            $this->warn('No products found.');
            return self::SUCCESS;
        }

        $updated = 0;
        foreach ($products as $product) {
            $categoryName = $product->category?->name ?? 'Seafood';
            $desc = $this->descriptionFor($product->name, $categoryName, $product->id);
            if ($desc !== $product->description) {
                $product->update(['description' => $desc]);
                $this->line("Updated: {$product->name}");
                $updated++;
            }
        }

        $this->info("Done. Updated {$updated} product descriptions.");
        return self::SUCCESS;
    }

    private function descriptionFor(string $productName, string $categoryName, int $id): string
    {
        $templates = $this->templatesForCategory($categoryName);
        $idx = $id % count($templates);
        $template = $templates[$idx];

        return str_replace('{name}', $productName, $template);
    }

    private function templatesForCategory(string $categoryName): array
    {
        $base = [
            'Fresh Water Fish' => [
                '{name} is a premium freshwater species from Pakistani rivers and lakes. Akhlaq Enterprises supplies it fresh or IQF frozen, meeting export quality standards for global markets.',
                'Sourced from trusted freshwater farms and natural waters, {name} is processed under strict hygiene and freezing standards. Ideal for retail and food service buyers worldwide.',
                'Our {name} is handled with care from harvest to packing. Fresh and block-frozen options available; suitable for HACCP-compliant export to EU, UK, and other regions.',
            ],
            'Sea Water Fish' => [
                '{name} from the Arabian Sea is processed and frozen to preserve freshness and texture. Akhlaq Enterprises delivers export-grade quality for international buyers.',
                'Premium {name} caught and processed in Pakistan. Available in IQF and block-frozen forms; packed to meet international standards for seafood export.',
                'Sustainably handled {name} for global markets. We ensure strict quality control from catch to cold chain, suitable for demanding export specifications.',
            ],
            'Shrimps / Prawns' => [
                '{name} from Akhlaq Enterprises is processed and packed to international standards. Farmed and wild-caught options; IQF and block packing available for export.',
                'Premium {name} for retail and food service. Processed in HACCP-compliant facilities and shipped frozen to preserve quality and shelf life.',
                'Our {name} is graded, cleaned, and frozen for consistent quality. Suitable for EU, UK, and other markets requiring full traceability and food safety compliance.',
            ],
            'Lobsters' => [
                '{name} is supplied live, fresh, or frozen by Akhlaq Enterprises. Sourced from Pakistani waters and handled to meet export requirements for premium shellfish.',
                'Premium {name} for international buyers. Processed and packed with care; ideal for restaurants and distributors seeking reliable lobster supply.',
                'Export-quality {name} from Pakistan. We ensure proper handling and cold chain from harvest to delivery, meeting strict quality and size specifications.',
            ],
            'Shells' => [
                '{name} from Akhlaq Enterprises is cleaned, graded, and packed for export. Processed under hygiene standards suitable for global seafood markets.',
                'Premium {name} sourced and processed in Pakistan. Available in forms suitable for retail and food service; packed to international specifications.',
                'Our {name} is handled from harvest to packing with quality in mind. Ideal for buyers seeking consistent shellfish supply from a certified exporter.',
            ],
            'Jellyfish' => [
                '{name} is traditionally processed and packed for export. Akhlaq Enterprises supplies quality product meeting specifications for Asian and international markets.',
                'Premium {name} from Pakistan, processed and salted to standard. Suitable for food service and retail distribution in regions where jellyfish is in demand.',
                'Our {name} is handled with care to preserve texture and quality. Packed for export with full traceability and compliance to buyer requirements.',
            ],
            'Cephalopods' => [
                '{name} from Akhlaq Enterprises is processed and frozen for export. Handled to preserve texture and meet international quality standards for cephalopod products.',
                'Premium {name} for global markets. IQF and block-frozen options; suitable for food service and retail where consistent quality and size matter.',
                'Our {name} is sourced from Pakistani waters and processed in certified facilities. Full cold chain and packing to specifications for EU, UK, and other regions.',
            ],
            'Crabs' => [
                '{name} is supplied live, fresh, or frozen by Akhlaq Enterprises. Processed and packed to export standards for buyers seeking premium crab from Pakistan.',
                'Premium {name} for international distribution. Handled and packed with care; suitable for restaurants and retailers requiring reliable crab supply.',
                'Export-quality {name} from Pakistani waters. We ensure proper grading, processing, and cold chain from harvest to delivery.',
            ],
        ];

        $fallback = [
            'Premium {name} from Akhlaq Enterprises. Processed and packed to international standards for global export.',
            'Our {name} is sourced and handled with care. Quality-controlled for export to EU, UK, and other markets.',
        ];

        return $base[$categoryName] ?? $fallback;
    }
}
