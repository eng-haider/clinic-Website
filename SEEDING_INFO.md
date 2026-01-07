# Database Seeding Information

This document provides information about the test data seeders included in this Laravel project.

## Seeded Data Overview

The database seeders populate your application with realistic test data for development and testing purposes.

### Data Counts

-   **Services**: 6 dental services
-   **Doctors**: 6 dentists with different specializations
-   **Testimonials**: 8 patient testimonials
-   **Blog Posts**: 6 articles about dental care
-   **Settings**: 30 configuration settings

## Running the Seeders

### Seed Database (Keep Existing Data)

```bash
php artisan db:seed
```

### Fresh Migration with Seeding (Drops All Tables)

```bash
php artisan migrate:fresh --seed
```

### Run Specific Seeder

```bash
php artisan db:seed --class=ServiceSeeder
php artisan db:seed --class=DoctorSeeder
php artisan db:seed --class=TestimonialSeeder
php artisan db:seed --class=PostSeeder
php artisan db:seed --class=SettingSeeder
```

## Seeded Data Details

### Services (6 items)

1. **Teeth Cleaning** - Professional dental cleaning service
2. **Dental Implants** - Permanent tooth replacement solution
3. **Teeth Whitening** - Advanced whitening treatments
4. **Root Canal Treatment** - Painless root canal therapy
5. **Orthodontics** - Braces and clear aligners
6. **Cosmetic Dentistry** - Veneers, bonding, and smile makeovers

All services include:

-   Icon class (flaticon)
-   Short description
-   Full detailed description
-   Image path
-   Active status
-   Display order

### Doctors (6 specialists)

1. **Dr. Sarah Johnson** - General Dentistry (15 years experience)
2. **Dr. Michael Chen** - Orthodontics (12 years experience)
3. **Dr. Emily Rodriguez** - Pediatric Dentistry (10 years experience)
4. **Dr. David Williams** - Oral Surgery (18 years experience)
5. **Dr. Lisa Anderson** - Cosmetic Dentistry (14 years experience)
6. **Dr. James Taylor** - Endodontics (11 years experience)

Each doctor includes:

-   Name, specialization, and degree
-   Professional biography
-   Profile image
-   Email and phone contact
-   Social media links (Facebook, Twitter, Instagram, LinkedIn)
-   Years of experience
-   Active status and display order

### Testimonials (8 reviews)

All testimonials feature:

-   Patient name and title/occupation
-   Detailed review content
-   5-star ratings
-   Patient photo
-   Active status

Reviews cover various services:

-   Teeth whitening experience
-   Children's dentistry
-   Dental implants
-   Cosmetic dentistry
-   Root canal treatment
-   Orthodontic treatment
-   General dental care

### Blog Posts (6 articles)

1. **5 Essential Tips for Maintaining Healthy Teeth**

    - Category: Dental Care
    - Tags: oral hygiene, dental tips, preventive care
    - Author: Dr. Sarah Johnson

2. **Understanding Dental Implants: A Complete Guide**

    - Category: Dental Procedures
    - Tags: dental implants, tooth replacement, oral surgery
    - Author: Dr. David Williams

3. **How to Prepare Your Child for Their First Dental Visit**

    - Category: Pediatric Dentistry
    - Tags: children's dentistry, first dental visit, pediatric care
    - Author: Dr. Emily Rodriguez

4. **The Truth About Teeth Whitening: Myths vs Facts**

    - Category: Cosmetic Dentistry
    - Tags: teeth whitening, cosmetic dentistry, dental myths
    - Author: Dr. Lisa Anderson

5. **Signs You Need a Root Canal and What to Expect**

    - Category: Dental Procedures
    - Tags: root canal, endodontics, tooth pain
    - Author: Dr. James Taylor

6. **Orthodontic Treatment Options: Braces vs Invisalign**
    - Category: Orthodontics
    - Tags: braces, invisalign, orthodontics, teeth straightening
    - Author: Dr. Michael Chen

All posts include:

-   SEO-friendly slug
-   Rich HTML content with headings and lists
-   Featured image
-   Author attribution
-   Category and tags
-   Published status and date

### Settings (30 configuration items)

**General Information**

-   Clinic name: Smile Dental Clinic

**Contact Information**

-   Email: info@smiledentalclinic.com
-   Phone: +1 (555) 123-4567
-   Address: 123 Dental Street, Suite 100, New York, NY 10001
-   Emergency phone: +1 (555) 999-8888

**Business Hours**

-   Monday - Thursday: 9:00 AM - 6:00 PM
-   Friday: 9:00 AM - 5:00 PM
-   Saturday: 10:00 AM - 3:00 PM
-   Sunday: Closed

**Social Media**

-   Facebook, Twitter, Instagram, LinkedIn, YouTube links

**Features (4 key features)**

1. Expert Dentists
2. Modern Equipment
3. Affordable Prices
4. Emergency Care

**SEO**

-   Meta description and keywords for search engines

## Using Seeded Data

### In Filament Admin Panel

1. Visit `/admin` and login
2. Navigate to each resource to see the seeded data
3. Edit, delete, or add more records as needed

### On Frontend

1. Visit the homepage to see services and testimonials
2. Browse `/services` to view all dental services
3. Visit `/doctors` to see the team
4. Check `/blog` for articles
5. View `/testimonials` for patient reviews

### In Code

Access settings using the helper function:

```php
$clinicName = setting('clinic_name');
$phone = setting('clinic_phone', 'Default Phone');
```

## Resetting Test Data

To completely reset your database and reseed:

```bash
# This will drop all tables, run migrations, and seed data
php artisan migrate:fresh --seed
```

**Warning**: This command will delete ALL existing data!

## Customizing Seed Data

All seeders are located in `database/seeders/` directory:

-   `ServiceSeeder.php`
-   `DoctorSeeder.php`
-   `TestimonialSeeder.php`
-   `PostSeeder.php`
-   `SettingSeeder.php`
-   `DatabaseSeeder.php` (calls all seeders)

Edit these files to:

-   Add more sample data
-   Modify existing data
-   Change image paths
-   Update contact information

## Image Assets

The seeded data references images from the original template:

-   Services: `assets/img/services/`
-   Doctors: `assets/img/team/`
-   Testimonials: `assets/img/clients/`
-   Blog: `assets/img/blog/`

Make sure these directories exist and contain the referenced images.

## Production Considerations

**Important**: These seeders are for development/testing only!

For production:

1. Do NOT run seeders on production database
2. Use Filament admin panel to add real data
3. Replace all test emails, phone numbers, and addresses
4. Upload actual photos for doctors and services
5. Write genuine testimonials and blog posts

## Troubleshooting

### Issue: "SQLSTATE[23000]: Integrity constraint violation"

**Solution**: Run `php artisan migrate:fresh --seed` to reset the database

### Issue: "Class 'Database\Seeders\ServiceSeeder' not found"

**Solution**: Run `composer dump-autoload` to regenerate autoload files

### Issue: Images not showing on frontend

**Solution**: Ensure image files exist in the `public/assets/img/` directories

## Next Steps

After seeding:

1. ✅ Check Filament admin panel to verify data
2. ✅ Visit frontend pages to see how data displays
3. ✅ Test creating/editing records through admin panel
4. ✅ Customize the seeded data to match your needs
5. ✅ Add more test data if needed
6. ✅ Start building additional features

---

**Last Updated**: December 12, 2025
