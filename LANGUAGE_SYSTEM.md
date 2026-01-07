# Multi-Language System Documentation

This document explains the Arabic/English language switching system implemented in the clinic website.

## Overview

The website now supports **Arabic (RTL)** as the default language with the ability to switch to **English (LTR)**.

## Features Implemented

### ✅ Default Language: Arabic (RTL)

-   Right-to-left text direction
-   Arabic-optimized layout
-   RTL Bootstrap integration

### ✅ Language Switcher

-   Globe icon with language code (AR/EN)
-   Located in the main navigation bar
-   Also available in mobile menu
-   Maintains session across page navigation

### ✅ RTL Support

-   Custom RTL CSS file
-   Bootstrap RTL version for Arabic
-   Proper text alignment and direction
-   Mirrored layout elements

## How It Works

### 1. Default Configuration

In `config/app.php`:

```php
'locale' => env('APP_LOCALE', 'ar'),  // Default is Arabic
'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
```

### 2. Middleware

`SetLocale` middleware automatically applies the selected language from session:

-   Checks session for saved language preference
-   Falls back to Arabic if no preference set
-   Validates language code (only 'ar' or 'en' allowed)

### 3. Language Switching

Users can switch language by:

-   Clicking the globe icon in the header
-   Using the language button in mobile menu
-   Language preference saved in session
-   Redirects back to current page

### 4. RTL Layout

When Arabic is active:

-   `dir="rtl"` applied to `<html>` tag
-   Bootstrap RTL CSS loaded
-   Custom RTL stylesheet applied
-   Text alignment right
-   Mirrored UI elements

## File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── LanguageController.php      # Handles language switching
│   └── Middleware/
│       └── SetLocale.php                # Sets locale for each request

bootstrap/
└── app.php                              # Middleware registration

config/
└── app.php                              # Default locale configuration

public/
└── assets/
    └── css/
        └── rtl.css                      # RTL-specific styles

resources/
└── views/
    ├── layouts/
    │   └── app.blade.php               # Dynamic dir attribute & RTL CSS
    └── partials/
        └── header.blade.php            # Language switcher UI

routes/
└── web.php                             # Language switch route
```

## Usage

### For Users

**Desktop Navigation:**

1. Look for the globe icon (🌐) in the top navigation
2. Click it to toggle between Arabic and English
3. The page will reload with the new language

**Mobile Navigation:**

1. Open the mobile menu (hamburger icon)
2. Scroll to the bottom
3. Click "Switch to English" or "التبديل إلى العربية" button

### For Developers

**Check Current Language:**

```php
app()->getLocale()  // Returns 'ar' or 'en'
```

**Display Content Based on Language:**

```blade
@if(app()->getLocale() == 'ar')
    <p>محتوى عربي</p>
@else
    <p>English content</p>
@endif
```

**Create Language-Specific Routes:**

```php
Route::get('/about', function() {
    return view('about.' . app()->getLocale());
});
```

**Use Language in Controllers:**

```php
$locale = app()->getLocale();
$posts = Post::where('language', $locale)->get();
```

## Customization

### Adding More Languages

1. **Update Middleware** (`app/Http/Middleware/SetLocale.php`):

```php
if (!in_array($locale, ['ar', 'en', 'fr'])) {  // Add 'fr'
    $locale = 'ar';
}
```

2. **Update Language Controller** validation
3. **Create new CSS file** for the language if needed
4. **Add to language switcher** dropdown

### Customizing RTL Styles

Edit `public/assets/css/rtl.css` to adjust:

-   Text alignment
-   Padding/margin direction
-   Icon positions
-   Layout mirroring

### Creating Translation Files

Laravel supports translation files:

```bash
# Create language files
php artisan lang:publish
```

Then create:

-   `lang/ar/messages.php`
-   `lang/en/messages.php`

Use in views:

```blade
{{ __('messages.welcome') }}
```

## Language Switcher Icon

The language switcher uses:

-   **Icon**: `ri-global-line` (RemixIcon)
-   **Text**: Shows opposite language code (AR when EN is active, EN when AR is active)
-   **Tooltip**: Hover shows full language name
-   **Style**: Matches site primary color

## RTL CSS Features

The `rtl.css` file handles:

-   ✅ Text direction and alignment
-   ✅ Navbar and menu positioning
-   ✅ Button icon placement
-   ✅ Form field alignment
-   ✅ Breadcrumb direction
-   ✅ Card layouts
-   ✅ Footer elements
-   ✅ Swiper/carousel buttons
-   ✅ Modal and offcanvas positioning
-   ✅ Responsive adjustments

## Testing

### Test Language Switching:

1. Visit the homepage
2. Click the language switcher
3. Verify layout changes to RTL/LTR
4. Navigate to different pages
5. Confirm language persists

### Test RTL Layout:

1. Switch to Arabic
2. Check text alignment (right)
3. Verify menu positioning
4. Test mobile responsive menu
5. Check form inputs
6. Review footer layout

## Browser Compatibility

Tested and working on:

-   ✅ Chrome/Edge (latest)
-   ✅ Firefox (latest)
-   ✅ Safari (latest)
-   ✅ Mobile browsers (iOS/Android)

## Session Management

Language preference is stored in:

-   **Storage**: Laravel session
-   **Duration**: Until browser closes (default)
-   **Scope**: Entire website

To persist across browser restarts, update session config:

```php
// config/session.php
'lifetime' => 120,  // 120 minutes
```

## Production Checklist

Before deploying:

-   [ ] Test both languages thoroughly
-   [ ] Verify RTL layout on all pages
-   [ ] Check mobile responsiveness
-   [ ] Test language persistence
-   [ ] Optimize CSS files
-   [ ] Cache configuration
-   [ ] Test on different browsers
-   [ ] Verify SEO tags for both languages

## Troubleshooting

### Issue: Language not changing

**Solution**: Clear session cache

```bash
php artisan cache:clear
php artisan session:clear
```

### Issue: RTL layout broken

**Solution**:

1. Check `rtl.css` is loading
2. Verify Bootstrap RTL CDN is accessible
3. Clear browser cache

### Issue: Icons reversed in RTL

**Solution**: Update icon CSS in `rtl.css`:

```css
body[dir="rtl"] .btn i {
    margin-right: 0;
    margin-left: 8px;
}
```

## Future Enhancements

Potential improvements:

1. **Database Translation**: Store content in multiple languages
2. **URL Localization**: `/ar/about` vs `/en/about`
3. **Auto-detect**: Use browser language preference
4. **Translation Files**: Use Laravel's localization features
5. **Language-specific Images**: Load different images per language
6. **SEO**: Add hreflang tags for better SEO

## Support

For questions or issues:

1. Check this documentation
2. Review the code comments
3. Test in different browsers
4. Clear caches and try again

---

**Last Updated**: December 12, 2025
**Default Language**: Arabic (RTL)
**Supported Languages**: Arabic (ar), English (en)
