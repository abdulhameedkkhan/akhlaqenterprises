<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class MergeBoalDuplicateCommand extends Command
{
    protected $signature = 'products:merge-boal';

    protected $description = 'Remove duplicate Boal (same as Helicopter Catfish / Boal), keep one product';

    public function handle(): int
    {
        $boal = Product::where('name', 'Boal')->first();
        $heliBoal = Product::where('name', 'Helicopter Catfish / Boal')->first();

        if (!$heliBoal && !$boal) {
            $this->warn('Neither "Boal" nor "Helicopter Catfish / Boal" found.');
            return self::SUCCESS;
        }

        if (!$heliBoal) {
            $this->info('Only "Boal" exists. Renaming to "Helicopter Catfish / Boal".');
            $boal->update(['name' => 'Helicopter Catfish / Boal']);
            return self::SUCCESS;
        }

        if (!$boal) {
            $this->info('Only "Helicopter Catfish / Boal" exists. No duplicate.');
            return self::SUCCESS;
        }

        $this->info('Removing duplicate "Boal" (same fish as Helicopter Catfish / Boal).');
        $boal->delete();
        $this->info('Done. Kept: Helicopter Catfish / Boal');
        return self::SUCCESS;
    }
}
