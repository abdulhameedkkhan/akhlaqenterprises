@echo off
echo =========================================
echo  Laravel Performance Optimization Script
echo =========================================
echo.

echo [1/7] Clearing all caches...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

echo.
echo [2/7] Building optimized autoloader...
composer dump-autoload -o

echo.
echo [3/7] Caching configuration...
php artisan config:cache

echo.
echo [4/7] Caching routes...
php artisan route:cache

echo.
echo [5/7] Caching views...
php artisan view:cache

echo.
echo [6/7] Running Laravel optimize...
php artisan optimize

echo.
echo [7/7] Building production assets...
npm run build

echo.
echo =========================================
echo  Optimization Complete!
echo =========================================
echo.
echo Next steps:
echo 1. Test the website in your browser
echo 2. Run Lighthouse performance test
echo 3. Check PHP OpCache is enabled (see PHP_OPCACHE_CONFIG.md)
echo.
pause
