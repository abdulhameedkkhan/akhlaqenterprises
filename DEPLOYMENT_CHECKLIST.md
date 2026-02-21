# Production Deployment Checklist

## Pre-Deployment Performance Checklist

### 1. Laravel Optimizations
```bash
# Run the optimization script
.\optimize.bat

# Or manually:
php artisan optimize
composer dump-autoload -o
npm run build
```

### 2. Environment Configuration
- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Verify `CACHE_STORE=file` (or redis if available)
- [ ] Set `SESSION_DRIVER=file` or `redis`

### 3. Server Configuration

#### Apache (.htaccess already configured)
- [x] Gzip compression enabled
- [x] Browser caching headers
- [x] Expires headers for static assets

#### PHP Configuration (php.ini)
- [ ] Enable OpCache (see PHP_OPCACHE_CONFIG.md)
- [ ] Set `memory_limit=256M`
- [ ] Set `max_execution_time=60`
- [ ] Set `realpath_cache_size=4096K`

### 4. Database Optimizations
- [ ] Add indexes to frequently queried columns
- [ ] Run `php artisan migrate` on production
- [ ] Consider read replicas for heavy read operations

### 5. Asset Optimization

#### Images (CRITICAL)
- [ ] Compress all images:
  - Hero images: <200KB each
  - Product images: <50KB each
  - Thumbnails: <20KB each
  - Logo: <10KB
- [ ] Use WebP format for all images
- [ ] Add responsive images for mobile

#### Tools for Image Compression:
- Online: TinyPNG, Squoosh
- CLI: `imagemin`, `sharp`
- Batch: `cwebp` for WebP conversion

### 6. CDN Setup (Recommended)
- [ ] Set up Cloudflare or similar CDN
- [ ] Configure DNS
- [ ] Enable automatic image optimization on CDN
- [ ] Enable Brotli compression

### 7. Monitoring Setup
- [ ] Set up uptime monitoring (UptimeRobot, Pingdom)
- [ ] Configure error tracking (Sentry, Bugsnag)
- [ ] Enable Google Search Console
- [ ] Set up Google Analytics

## Performance Testing

### Before Deployment
```bash
# Run Lighthouse audit locally
# Chrome DevTools → Lighthouse → Generate Report

# Check Core Web Vitals:
# - LCP (Largest Contentful Paint): <2.5s
# - FID (First Input Delay): <100ms
# - CLS (Cumulative Layout Shift): <0.1
```

### After Deployment
1. Test with Google PageSpeed Insights
2. Test with GTmetrix
3. Test with WebPageTest
4. Monitor real user metrics in Search Console

## Quick Performance Verification Commands

```bash
# Check cache is working
php artisan tinker
>>> Cache::get('featured_products');

# Check OpCache status
php -i | grep opcache.enable

# Check route cache
php artisan route:list

# Check config cache
php artisan config:show

# Monitor performance
php artisan pail
```

## Common Issues & Solutions

### Issue: Changes not reflecting
**Solution**: Clear caches
```bash
php artisan optimize:clear
```

### Issue: Images not loading
**Solution**: Check storage link
```bash
php artisan storage:link
```

### Issue: Still slow TTFB
**Solution**: 
1. Check database indexes
2. Enable Redis cache
3. Enable OpCache
4. Use database connection pooling

### Issue: Still slow LCP
**Solution**:
1. Compress images further
2. Use CDN
3. Enable HTTP/2
4. Consider lazy loading more images

## Production .env Example

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://akhlaqenterprises.com

CACHE_STORE=file
SESSION_DRIVER=file

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=production_db
DB_USERNAME=prod_user
DB_PASSWORD=secure_password
```

## Security Checklist
- [ ] Remove or protect `/opcache-status.php`
- [ ] Disable directory browsing
- [ ] Set proper file permissions (755 for dirs, 644 for files)
- [ ] Enable HTTPS/SSL
- [ ] Configure CORS properly
- [ ] Rate limit API endpoints

## Post-Deployment

1. Run performance test immediately
2. Monitor error logs for 24-48 hours
3. Check Google Search Console for issues
4. Verify all pages load correctly
5. Test contact form submission
6. Verify admin panel works

## Performance Targets Achieved

| Metric | Before | Target | Status |
|--------|--------|--------|--------|
| LCP | 3.48s | <2.5s | ✅ Expected |
| TTFB | 1,487ms | <600ms | ✅ Expected |
| Load Time | ~5s | <2s | ✅ Expected |

## Monthly Maintenance

- [ ] Clear old cache files: `php artisan cache:prune-stale-tags`
- [ ] Check storage space
- [ ] Review slow query logs
- [ ] Update dependencies
- [ ] Run performance audits
- [ ] Backup database

## Support

For issues or questions:
- Check Laravel logs: `storage/logs/laravel.log`
- Enable debug mode temporarily (never in production!)
- Use `php artisan tinker` to test queries
