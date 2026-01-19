# Social Links (Link in Bio) System

## Overview

A beautiful "Link in Bio" page system similar to Linktree, allowing you to create a centralized page with all your important links (social media, booking, website, etc.).

## Features

- ✅ Beautiful, responsive design with gradient background
- ✅ Support for multiple social media platforms (Facebook, Instagram, Twitter, LinkedIn, YouTube, TikTok, WhatsApp, Telegram, Snapchat)
- ✅ Custom links support
- ✅ Platform-specific colors and icons
- ✅ Drag-and-drop ordering
- ✅ Show/hide individual links
- ✅ Admin panel management via Filament
- ✅ Bilingual support (English/Arabic)
- ✅ RTL support for Arabic
- ✅ Smooth animations
- ✅ Mobile-friendly design

## Access the Page

Visit: **`https://yourdomain.com/links`**

## Admin Management

### Adding a New Link

1. Go to Admin Panel → **Social Links**
2. Click **"New Social Link"**
3. Fill in the form:
   - **Title**: Display name (e.g., "Facebook", "Instagram")
   - **URL**: Full URL including https://
   - **Platform**: Select from dropdown (optional, for automatic styling)
   - **Icon**: Font Awesome icon class (e.g., `fab fa-facebook`)
   - **Description**: Optional short description
   - **Order**: Lower numbers appear first
   - **Active**: Toggle to show/hide the link
4. Click **"Create"**

### Editing Links

1. Go to Admin Panel → **Social Links**
2. Click the **Edit** icon next to any link
3. Modify the fields
4. Click **"Save"**

### Reordering Links

Simply change the **Order** field for each link. Links are displayed in ascending order (1, 2, 3, etc.).

## Supported Platforms

### Social Media

- **Facebook** - `fab fa-facebook`
- **Instagram** - `fab fa-instagram`
- **Twitter/X** - `fab fa-twitter` or `fab fa-x-twitter`
- **LinkedIn** - `fab fa-linkedin`
- **YouTube** - `fab fa-youtube`
- **TikTok** - `fab fa-tiktok`
- **Snapchat** - `fab fa-snapchat`

### Messaging Apps

- **WhatsApp** - `fab fa-whatsapp`
- **Telegram** - `fab fa-telegram`

### Custom Links

- **Website** - `fas fa-globe`
- **Email** - `fas fa-envelope`
- **Phone** - `fas fa-phone`
- **Location** - `fas fa-map-marker-alt`
- **Booking** - `fas fa-calendar-check`
- **Any custom link** - Use any Font Awesome icon

## Font Awesome Icons

### Finding Icons

1. Visit: https://fontawesome.com/icons
2. Search for an icon
3. Copy the icon class (e.g., `fab fa-facebook`)
4. Paste it in the **Icon** field

### Common Icon Prefixes

- `fab` - Brands (Facebook, Instagram, etc.)
- `fas` - Solid icons (Globe, Phone, etc.)
- `far` - Regular icons
- `fal` - Light icons

## Platform-Specific Colors

Each platform has its own brand colors that automatically apply:

- **Facebook**: Blue (#1877f2)
- **Instagram**: Gradient (orange to purple)
- **Twitter/X**: Light blue (#1da1f2)
- **LinkedIn**: Blue (#0077b5)
- **YouTube**: Red (#ff0000)
- **WhatsApp**: Green (#25d366)
- **Telegram**: Blue (#0088cc)
- **Snapchat**: Yellow (#fffc00)
- **Custom**: Purple gradient (default)

## Example Links

### Social Media Links

```
Title: Facebook
URL: https://facebook.com/yourclinic
Platform: facebook
Icon: fab fa-facebook
Description: Follow us for daily updates
Order: 1
```

```
Title: Instagram
URL: https://instagram.com/yourclinic
Platform: instagram
Icon: fab fa-instagram
Description: See our before & after results
Order: 2
```

### WhatsApp Link

```
Title: WhatsApp
URL: https://wa.me/1234567890
Platform: whatsapp
Icon: fab fa-whatsapp
Description: Chat with us directly
Order: 3
```

### Custom Links

```
Title: Book Appointment
URL: https://yourdomain.com/book-appointment
Platform: custom
Icon: fas fa-calendar-check
Description: Schedule your visit today
Order: 4
```

```
Title: Our Website
URL: https://yourdomain.com
Platform: website
Icon: fas fa-globe
Description: Visit our full website
Order: 5
```

## Database Structure

### Table: `social_links`

```sql
- id (bigint, primary key)
- title (string) - Display name
- url (string) - Full URL
- icon (string, nullable) - Font Awesome icon class
- platform (string, nullable) - Platform identifier
- description (text, nullable) - Optional description
- order (integer) - Display order
- is_active (boolean) - Show/hide toggle
- created_at (timestamp)
- updated_at (timestamp)
```

## Customization

### Changing Background Gradient

Edit `/resources/views/links/index.blade.php`:

```css
body {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  /* Change these colors to your preference */
}
```

### Changing Link Colors

Edit the `.link-item` hover state in the same file.

### Adding New Platforms

Add to the Filament resource (`app/Filament/Resources/SocialLinkResource.php`):

```php
'newplatform' => 'New Platform Name',
```

Then add the color in the view file:

```css
.link-item[data-platform="newplatform"] .link-icon {
  background: linear-gradient(135deg, #color1 0%, #color2 100%);
}
```

## Files Created

### Models

- `app/Models/SocialLink.php` - Social link model

### Controllers

- `app/Http/Controllers/LinksController.php` - Handles the links page

### Views

- `resources/views/links/index.blade.php` - Main links page template

### Migrations

- `database/migrations/XXXX_create_social_links_table.php` - Database table

### Seeders

- `database/seeders/SocialLinkSeeder.php` - Sample data

### Filament Resources

- `app/Filament/Resources/SocialLinkResource.php` - Admin panel interface
- `app/Filament/Resources/SocialLinkResource/Pages/` - Filament pages

### Routes

- Added to `routes/web.php`: `/links` route

## API Endpoints

- `GET /links` - Display the links page

## Tips & Best Practices

1. **Keep URLs Clean**: Always include `https://` in URLs
2. **Use Descriptions Wisely**: Short, compelling descriptions work best
3. **Order Matters**: Put your most important links first (lower order numbers)
4. **Test Links**: Always verify links work before making them active
5. **Mobile First**: The page is designed mobile-first, so it looks great on phones
6. **Update Regularly**: Keep your links current and remove outdated ones
7. **Use Icons**: Icons make links more recognizable and attractive

## Sharing Your Links Page

Share your links page URL on:

- Instagram bio
- TikTok bio
- Twitter/X bio
- Facebook page description
- Business cards
- Email signatures
- Print materials

## Troubleshooting

### Link not showing?

- Check if `is_active` is set to `true`
- Verify the order number
- Clear browser cache

### Icon not displaying?

- Verify Font Awesome icon class is correct
- Check internet connection (icons load from CDN)
- Use prefix: `fab` for brands, `fas` for solid

### Wrong order?

- Check the `order` field in admin panel
- Lower numbers appear first

### Platform color not applying?

- Ensure `platform` field matches exactly (lowercase)
- Check if platform is defined in CSS

## Future Enhancements (Optional)

- [ ] Click tracking/analytics
- [ ] Custom colors per link
- [ ] Scheduled links (show/hide based on dates)
- [ ] Link categories/groups
- [ ] Multiple link pages for different purposes
- [ ] QR code generation for the page
- [ ] Custom themes
- [ ] Link preview images

## Support

For issues or questions, contact your development team or refer to:

- Laravel Documentation: https://laravel.com/docs
- Filament Documentation: https://filamentphp.com/docs
- Font Awesome Icons: https://fontawesome.com/icons

---

**Created**: January 19, 2026
**Version**: 1.0.0
**Status**: ✅ Production Ready
