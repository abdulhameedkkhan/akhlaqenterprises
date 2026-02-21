# Image Optimization Guide

## Why This Matters

Your **Resource Load Duration is 1,880ms** - this is primarily caused by:
- Large, uncompressed images
- Missing images (404 errors slow down loading)
- No image optimization pipeline

## Critical: Check Your Images

First, verify your images exist and check their sizes:

```bash
# Check if images folder exists and list files
dir public\images

# Check image sizes
Get-ChildItem -Path public\images -File | Select-Object Name, @{Name="SizeKB";Expression={[math]::Round($_.Length/1KB, 0)}}
```

## Target Image Sizes

| Image Type | Max Size | Dimensions | Format |
|------------|----------|------------|--------|
| **Hero/Slider** | 150-200KB | 1920x1080 | WebP |
| **Product Images** | 30-50KB | 800x800 | WebP |
| **Thumbnails** | 10-20KB | 400x400 | WebP |
| **Logo** | 5-10KB | 200x200 | WebP/PNG |
| **Gallery Images** | 80-120KB | 1200x900 | WebP |

## Images Currently Referenced in Your Code

Based on the codebase, these images are being loaded:

### Critical (First Load)
- `images/hero.webp` - Hero slider slide 1 ⚠️ **MUST BE <200KB**
- `images/logo.webp` - Navigation logo ⚠️ **MUST BE <10KB**

### Important (Lazy Loaded)
- `images/fresh-display.webp` - Slider slide 2
- `images/processing.webp` - Slider slide 3
- `videos/featured-bg.mp4` - Background video ⚠️ **Should be <5MB**
- `videos/products-bg.mp4` - Products page video

### Product Images (Dynamic)
- Loaded from database `$product->image` field
- Should each be <50KB

## Quick Fix: Online Compression

### Option 1: TinyPNG (Easiest)
1. Go to https://tinypng.com
2. Upload your images (max 5MB each)
3. Download optimized versions
4. Replace originals in `public/images/`

**Expected Compression**: 60-80% size reduction!

### Option 2: Squoosh (More Control)
1. Go to https://squoosh.app
2. Upload image
3. Select **WebP** format
4. Adjust quality slider (75-85 is usually perfect)
5. Compare before/after
6. Download and replace

## Automated Solution: Node Script

Create `optimize-images.js`:

```javascript
const sharp = require('sharp');
const fs = require('fs');
const path = require('path');

const inputDir = './public/images';
const outputDir = './public/images-optimized';

// Create output directory
if (!fs.existsSync(outputDir)) {
    fs.mkdirSync(outputDir, { recursive: true });
}

// Optimization presets
const presets = {
    hero: { width: 1920, quality: 85 },
    product: { width: 800, quality: 80 },
    thumbnail: { width: 400, quality: 75 },
    logo: { width: 200, quality: 90 }
};

async function optimizeImage(inputPath, preset = 'product') {
    const filename = path.basename(inputPath, path.extname(inputPath));
    const outputPath = path.join(outputDir, `${filename}.webp`);
    
    const config = presets[preset];
    
    await sharp(inputPath)
        .resize(config.width, null, { withoutEnlargement: true })
        .webp({ quality: config.quality })
        .toFile(outputPath);
    
    const inputStats = fs.statSync(inputPath);
    const outputStats = fs.statSync(outputPath);
    const savings = ((1 - outputStats.size / inputStats.size) * 100).toFixed(1);
    
    console.log(`✓ ${filename}: ${(inputStats.size/1024).toFixed(0)}KB → ${(outputStats.size/1024).toFixed(0)}KB (${savings}% saved)`);
}

// Usage examples:
// optimizeImage('./public/images/hero.jpg', 'hero');
// optimizeImage('./public/images/product1.jpg', 'product');
```

### Install Required Package:
```bash
npm install sharp --save-dev
```

### Run Optimization:
```bash
node optimize-images.js
```

## Manual Image Optimization Process

### 1. For Hero/Slider Images (hero.webp, fresh-display.webp, processing.webp)

**Current Issue**: Likely >500KB each
**Target**: <200KB each

**Steps**:
1. Open in Squoosh.app
2. Select **WebP** format
3. Set quality to **82**
4. Set **Resize** to 1920px width (maintain aspect ratio)
5. Download and replace

### 2. For Product Images

**Target**: <50KB each

**Steps**:
1. Batch compress with TinyPNG
2. Or use Squoosh with:
   - Format: WebP
   - Quality: 78
   - Size: 800x800px max

### 3. For Logo (logo.webp)

**Target**: <10KB

**Steps**:
1. Use Squoosh
2. WebP quality: 85
3. Resize to 200x200px max
4. Or use PNG with 8-bit color depth

## Batch Conversion: PowerShell Script

If you have many images, use this PowerShell script:

```powershell
# Install cwebp (WebP converter) first
# Download from: https://developers.google.com/speed/webp/download

# Convert all JPG/PNG to WebP
Get-ChildItem public\images\* -Include *.jpg,*.jpeg,*.png | ForEach-Object {
    $output = $_.FullName -replace '\.(jpg|jpeg|png)$', '.webp'
    & cwebp -q 80 $_.FullName -o $output
    Write-Host "Converted: $($_.Name)"
}
```

## Video Optimization

Your videos (if they exist) should be:
- **Max size**: 5MB for background videos
- **Format**: MP4 (H.264 codec)
- **Resolution**: 1920x1080 max
- **Already deferred**: ✅ (loads after page load)

### Compress Videos:
- Online: https://www.freeconvert.com/video-compressor
- Desktop: HandBrake (free)
- Target bitrate: 2-3 Mbps

## Critical Images Checklist

Run this to see if your critical images exist:

```bash
# Check critical images
Test-Path public\images\hero.webp
Test-Path public\images\logo.webp
Test-Path public\images\fresh-display.webp
Test-Path public\images\processing.webp
```

If any return `False`, you need to add those images!

## Recommended Image Structure

```
public/images/
├── hero.webp          (Hero slider - <200KB)
├── fresh-display.webp (Slider 2 - <200KB)
├── processing.webp    (Slider 3 - <200KB)
├── logo.webp          (Logo - <10KB)
├── products/
│   ├── fish1.webp     (<50KB each)
│   ├── fish2.webp
│   └── ...
└── gallery/
    ├── facility1.webp (<120KB each)
    └── ...
```

## Advanced: Responsive Images

For even better performance, serve different sizes for mobile/desktop:

```html
<img 
    srcset="images/hero-mobile.webp 640w, 
            images/hero-tablet.webp 1024w, 
            images/hero-desktop.webp 1920w"
    sizes="100vw"
    src="images/hero-desktop.webp"
    alt="Hero"
    width="1920"
    height="1080"
    fetchpriority="high"
>
```

## Immediate Impact Images

Optimize these FIRST for maximum impact:

1. **hero.webp** - This is your LCP element! ⭐ HIGHEST PRIORITY
2. **logo.webp** - Loads on every page
3. **fresh-display.webp** - Slider image
4. **processing.webp** - Slider image

## Verification After Optimization

```bash
# Check new file sizes
Get-ChildItem public\images\*.webp | Select-Object Name, @{Name="KB";Expression={[math]::Round($_.Length/1KB, 0)}}

# Should see:
# hero.webp         : <200KB
# logo.webp         : <10KB
# fresh-display.webp: <200KB
# processing.webp   : <200KB
```

## Expected Impact

After optimizing images:
- **Resource Load Duration**: 1,880ms → ~400-600ms (70% improvement)
- **LCP**: Further 500-800ms improvement
- **Total Page Load**: Cut in half

## Tools Summary

| Tool | Type | Best For | Link |
|------|------|----------|------|
| TinyPNG | Online | Batch compression | tinypng.com |
| Squoosh | Online | Individual images | squoosh.app |
| Sharp | Node.js | Automated pipeline | npm install sharp |
| cwebp | CLI | Batch WebP conversion | Google WebP tools |

## Questions?

If images are missing or you need help:
1. Check if images exist: `dir public\images`
2. Check storage symlink: `php artisan storage:link`
3. Verify image paths in database: `php artisan tinker` → `Product::first()->image`
