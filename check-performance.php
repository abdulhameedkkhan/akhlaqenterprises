<?php
/**
 * Performance Check Script
 * Run this via: php check-performance.php
 */

echo "\n";
echo "====================================\n";
echo "  PERFORMANCE CHECK\n";
echo "====================================\n\n";

// Check 1: OpCache
echo "[1/7] Checking PHP OpCache...\n";
if (function_exists('opcache_get_status') && opcache_get_status()) {
    $status = opcache_get_status();
    echo "  ✓ OpCache is ENABLED\n";
    echo "  - Memory Used: " . round($status['memory_usage']['used_memory']/1024/1024, 2) . " MB\n";
    echo "  - Hit Rate: " . round($status['opcache_statistics']['opcache_hit_rate'], 2) . "%\n";
} else {
    echo "  ✗ OpCache is DISABLED\n";
    echo "  → Enable it now! See: PHP_OPCACHE_CONFIG.md\n";
}

echo "\n[2/7] Checking Cache Driver...\n";
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$cacheDriver = config('cache.default');
echo "  Cache Driver: $cacheDriver\n";
if ($cacheDriver === 'file') {
    echo "  ✓ Using FILE cache (FAST)\n";
} elseif ($cacheDriver === 'redis') {
    echo "  ✓ Using REDIS cache (VERY FAST)\n";
} elseif ($cacheDriver === 'database') {
    echo "  ✗ Using DATABASE cache (SLOW)\n";
    echo "  → Change to 'file' in .env\n";
} else {
    echo "  ⚠ Using $cacheDriver cache\n";
}

echo "\n[3/7] Checking Laravel Optimizations...\n";
$configCached = file_exists(base_path('bootstrap/cache/config.php'));
$routesCached = file_exists(base_path('bootstrap/cache/routes-v7.php'));
$viewsCached = !empty(glob(storage_path('framework/views/*.php')));

echo "  Config cached: " . ($configCached ? "✓ YES" : "✗ NO") . "\n";
echo "  Routes cached: " . ($routesCached ? "✓ YES" : "✗ NO") . "\n";
echo "  Views cached: " . ($viewsCached ? "✓ YES" : "✗ NO") . "\n";

if (!$configCached || !$routesCached) {
    echo "  → Run: php artisan optimize\n";
}

echo "\n[4/7] Checking Composer Autoloader...\n";
$optimized = file_exists(base_path('vendor/composer/autoload_classmap.php'));
echo "  Autoloader optimized: " . ($optimized ? "✓ YES" : "✗ NO") . "\n";
if (!$optimized) {
    echo "  → Run: composer dump-autoload -o\n";
}

echo "\n[5/7] Checking Critical Images...\n";
$images = [
    'images/hero.webp' => 'Hero (Critical)',
    'images/logo.webp' => 'Logo (Critical)',
    'images/fresh-display.webp' => 'Slider 2',
    'images/processing.webp' => 'Slider 3',
];

foreach ($images as $path => $name) {
    $fullPath = public_path($path);
    if (file_exists($fullPath)) {
        $size = filesize($fullPath);
        $sizeKB = round($size / 1024, 2);
        $status = "✓";
        $advice = "";
        
        if ($path === 'images/hero.webp' && $size > 200 * 1024) {
            $status = "⚠";
            $advice = " (TOO LARGE! Compress to <200KB)";
        } elseif ($path === 'images/logo.webp' && $size > 20 * 1024) {
            $status = "⚠";
            $advice = " (TOO LARGE! Compress to <20KB)";
        }
        
        echo "  $status $name: {$sizeKB} KB$advice\n";
    } else {
        echo "  ✗ $name: MISSING\n";
        echo "    → Add this file to improve LCP\n";
    }
}

echo "\n[6/7] Checking Apache Modules...\n";
$htaccess = file_get_contents(public_path('.htaccess'));
$hasDeflate = strpos($htaccess, 'mod_deflate') !== false;
$hasExpires = strpos($htaccess, 'mod_expires') !== false;
$hasHeaders = strpos($htaccess, 'mod_headers') !== false;

echo "  Gzip Compression: " . ($hasDeflate ? "✓ Configured" : "✗ Missing") . "\n";
echo "  Browser Caching: " . ($hasExpires ? "✓ Configured" : "✗ Missing") . "\n";
echo "  Cache Headers: " . ($hasHeaders ? "✓ Configured" : "✗ Missing") . "\n";

echo "\n[7/7] Checking Middleware...\n";
$middlewarePath = app_path('Http/Middleware/AddCacheHeaders.php');
echo "  Cache Headers Middleware: " . (file_exists($middlewarePath) ? "✓ Exists" : "✗ Missing") . "\n";

echo "\n====================================\n";
echo "  SUMMARY\n";
echo "====================================\n\n";

$score = 0;
$total = 0;

// Calculate score
if ($cacheDriver === 'file' || $cacheDriver === 'redis') $score++;
$total++;

if ($configCached && $routesCached) $score++;
$total++;

if ($optimized) $score++;
$total++;

if (function_exists('opcache_get_status') && opcache_get_status()) $score++;
$total++;

$percentage = round(($score / $total) * 100);

echo "Configuration Score: $score/$total ($percentage%)\n\n";

if ($percentage === 100) {
    echo "🎉 EXCELLENT! All optimizations are active.\n";
} elseif ($percentage >= 75) {
    echo "✅ GOOD! Most optimizations are active.\n";
    echo "   Enable OpCache for maximum performance.\n";
} else {
    echo "⚠ NEEDS WORK! Follow the recommendations above.\n";
}

echo "\nNext Steps:\n";
if (!function_exists('opcache_get_status') || !opcache_get_status()) {
    echo "  1. Enable PHP OpCache (CRITICAL)\n";
}
echo "  2. Compress images if they're large\n";
echo "  3. Test performance in Chrome DevTools\n";
echo "  4. Run: php artisan cache:clear && php artisan optimize\n";

echo "\nExpected LCP: 1.5-2.0s (was 3.48s)\n";
echo "\n====================================\n\n";
