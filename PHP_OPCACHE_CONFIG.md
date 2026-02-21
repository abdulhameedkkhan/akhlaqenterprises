# PHP OpCache Configuration for Laragon

## Overview
PHP OpCache significantly improves performance by caching compiled PHP bytecode in memory, eliminating the need to parse and compile PHP files on every request.

## Expected Performance Gain
- **TTFB Reduction**: 300-500ms
- **Memory Usage**: More efficient
- **Overall Speed**: 3-5x faster PHP execution

## Configuration Steps

### Option 1: Via Laragon GUI (Easiest)

1. Right-click Laragon tray icon
2. Click **PHP** → **php.ini**
3. Find the `[opcache]` section
4. Replace with the configuration below
5. Save and restart Laragon

### Option 2: Manual Configuration

1. Locate your `php.ini` file:
   - Laragon path: `C:\laragon\bin\php\php-8.x\php.ini`
   - Or click: Menu → PHP → php.ini

2. Find or add the `[opcache]` section and paste:

```ini
[opcache]
; Enable OpCache
opcache.enable=1
opcache.enable_cli=1

; Memory Configuration
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=10000

; Performance Settings
opcache.revalidate_freq=60
opcache.fast_shutdown=1
opcache.validate_timestamps=1

; Development vs Production
; For DEVELOPMENT (checks file changes every 60s):
opcache.revalidate_freq=60
opcache.validate_timestamps=1

; For PRODUCTION (uncomment these, comment above):
; opcache.revalidate_freq=0
; opcache.validate_timestamps=0
```

3. Save the file
4. Restart Laragon or restart Apache/Nginx

### Verify OpCache is Working

Create a file `public/opcache-status.php`:

```php
<?php
if (function_exists('opcache_get_status')) {
    $status = opcache_get_status();
    echo "<h1>OpCache is ENABLED ✓</h1>";
    echo "<pre>";
    print_r($status);
    echo "</pre>";
} else {
    echo "<h1>OpCache is DISABLED ✗</h1>";
    echo "<p>Check your php.ini configuration</p>";
}
```

Then visit: `http://localhost/opcache-status.php`

**IMPORTANT**: Delete this file after verification for security!

## OpCache Management Commands

### Clear OpCache
```bash
# Via PHP CLI
php -r "opcache_reset();"

# Or restart PHP-FPM/Apache
```

### Monitor OpCache
Install OpCache GUI:
```bash
composer require amnuts/opcache-gui --dev
```

## Configuration Explanation

| Setting | Value | Why |
|---------|-------|-----|
| `opcache.enable` | 1 | Turns on OpCache |
| `opcache.memory_consumption` | 256 | MB of memory for OpCache (adjust based on app size) |
| `opcache.interned_strings_buffer` | 16 | Memory for storing strings (classes, functions, etc.) |
| `opcache.max_accelerated_files` | 10000 | Max PHP files to cache (Laravel needs ~4000-8000) |
| `opcache.revalidate_freq` | 60 | How often to check for file changes (seconds) |
| `opcache.fast_shutdown` | 1 | Faster memory cleanup |
| `opcache.validate_timestamps` | 1 | Check if files changed (disable in production) |

## Production Optimization

For **production servers**, use these settings for maximum performance:

```ini
opcache.validate_timestamps=0
opcache.revalidate_freq=0
```

This completely disables file checking. You must manually clear OpCache when deploying:

```bash
php artisan opcache:clear
# or
service php8.x-fpm restart
```

## Troubleshooting

### OpCache Not Working?

1. Check PHP version: `php -v` (needs PHP 5.5+)
2. Check if enabled: `php -i | grep opcache.enable`
3. Verify module loaded: `php -m | grep Zend OPcache`

### OpCache Causing Issues?

Temporarily disable:
```ini
opcache.enable=0
```

Then restart PHP/Apache.

## Additional PHP Performance Settings

Add these to `php.ini` for better performance:

```ini
; Increase memory limit
memory_limit=256M

; Increase execution time (for imports/exports)
max_execution_time=60

; Realpath cache (reduces filesystem calls)
realpath_cache_size=4096K
realpath_cache_ttl=600
```

## Impact Summary

With OpCache enabled:
- **First request**: Normal speed (compiles and caches)
- **Subsequent requests**: 3-5x faster
- **TTFB**: Typically reduces by 300-500ms
- **Memory**: Slightly higher but more efficient
- **CPU**: Lower usage (no repeated compilation)
