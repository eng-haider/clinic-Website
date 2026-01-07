# Clinic Website - Laravel with Filament Admin Panel<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

A professional clinic/dental website built with Laravel and Filament admin panel for easy content management.<p align="center">

<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>

## Features<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>

<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>

-   🎨 Beautiful responsive design<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>

-   📊 Filament Admin Panel for content management</p>

-   🏥 Service management

-   👨‍⚕️ Doctor/Dentist profiles## About Laravel

-   📅 Appointment booking system

-   💬 Testimonials managementLaravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   📝 Blog system

-   ⚙️ Settings management- [Simple, fast routing engine](https://laravel.com/docs/routing).

-   🎯 SEO friendly- [Powerful dependency injection container](https://laravel.com/docs/container).

-   📱 Mobile responsive- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.

-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).

## Requirements- Database agnostic [schema migrations](https://laravel.com/docs/migrations).

-   [Robust background job processing](https://laravel.com/docs/queues).

-   PHP >= 8.2- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

-   Composer

-   MySQL/PostgreSQL/SQLiteLaravel is accessible, powerful, and provides tools required for large, robust applications.

-   Node.js & NPM (for asset compilation)

## Learning Laravel

## Installation

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

### 1. Navigate to the project directory

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

```bash

cd laravel-clinic## Laravel Sponsors

```

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### 2. Install PHP dependencies

### Premium Partners

````bash

composer install- **[Vehikl](https://vehikl.com)**

```- **[Tighten Co.](https://tighten.co)**

- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**

### 3. Install JavaScript dependencies- **[64 Robots](https://64robots.com)**

- **[Curotec](https://www.curotec.com/services/technologies/laravel)**

```bash- **[DevSquad](https://devsquad.com/hire-laravel-developers)**

npm install- **[Redberry](https://redberry.international/laravel-development)**

```- **[Active Logic](https://activelogic.com)**



### 4. Environment Configuration## Contributing



Copy the `.env.example` file to `.env`:Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).



```bash## Code of Conduct

cp .env.example .env

```In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).



Update your `.env` file with your database credentials:## Security Vulnerabilities



```envIf you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

DB_CONNECTION=sqlite

# For MySQL, use:## License

# DB_CONNECTION=mysql

# DB_HOST=127.0.0.1The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# DB_PORT=3306
# DB_DATABASE=clinic_db
# DB_USERNAME=root
# DB_PASSWORD=
````

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Create Admin User

Create your first admin user for Filament panel:

```bash
php artisan make:filament-user
```

Follow the prompts to enter:

-   Name
-   Email
-   Password

### 8. Create Storage Link

```bash
php artisan storage:link
```

### 9. Compile Assets

```bash
npm run dev
# Or for production:
npm run build
```

### 10. Start the Development Server

```bash
php artisan serve
```

Your application will be available at: `http://localhost:8000`

## Accessing the Admin Panel

1. Visit: `http://localhost:8000/admin`
2. Login with the credentials you created in step 7
3. Start managing your website content!

## Admin Panel Features

### Services Management

-   Add/Edit/Delete services
-   Upload service images
-   Set service icons
-   Manage service descriptions
-   Control visibility and ordering

### Doctors Management

-   Add doctor profiles
-   Upload doctor photos
-   Set specializations and degrees
-   Add biography and experience
-   Manage social media links
-   Control visibility and ordering

### Appointments Management

-   View all appointment requests
-   Update appointment status (pending, confirmed, cancelled, completed)
-   View patient information
-   Filter and search appointments

### Blog Posts Management

-   Create and publish blog posts
-   Rich text editor for content
-   Upload featured images
-   Set categories and tags
-   Schedule posts
-   SEO management

### Testimonials Management

-   Add patient testimonials
-   Upload patient photos
-   Set ratings (1-5 stars)
-   Control visibility and ordering

### Settings Management

-   Configure site-wide settings
-   Update contact information
-   Set working hours
-   Manage social media links
-   Update footer content

## Frontend Routes

-   **Home**: `/`
-   **Services**: `/services`
-   **Service Details**: `/services/{id}`
-   **Doctors**: `/doctors`
-   **Doctor Profile**: `/doctors/{id}`
-   **Book Appointment**: `/book-appointment`
-   **Blog**: `/blog`
-   **Blog Post**: `/blog/{id}`
-   **About Us**: `/about`
-   **Contact**: `/contact`
-   **Testimonials**: `/testimonials`
-   **FAQ**: `/faq`

## File Structure

```
laravel-clinic/
├── app/
│   ├── Filament/Resources/     # Filament admin resources
│   ├── Http/Controllers/        # Frontend controllers
│   ├── Models/                  # Eloquent models
│   └── Helpers/                 # Helper functions
├── database/
│   ├── migrations/              # Database migrations
│   └── seeders/                 # Database seeders
├── public/
│   └── assets/                  # Static assets (CSS, JS, images)
├── resources/
│   └── views/
│       ├── layouts/             # Blade layouts
│       ├── partials/            # Header, footer, etc.
│       └── *.blade.php          # Page templates
└── routes/
    └── web.php                  # Frontend routes
```

## Database Models

### Service

-   title
-   icon
-   description
-   full_description
-   image
-   is_active
-   order

### Doctor

-   name
-   specialization
-   degree
-   bio
-   image
-   email
-   phone
-   social_links
-   experience_years
-   is_active
-   order

### Appointment

-   patient_name
-   email
-   phone
-   doctor_id
-   appointment_date
-   appointment_time
-   message
-   status

### Testimonial

-   patient_name
-   patient_title
-   content
-   rating
-   image
-   is_active
-   order

### Post

-   title
-   slug
-   excerpt
-   content
-   featured_image
-   author
-   category
-   tags
-   is_published
-   published_at

### Setting

-   key
-   value
-   type
-   group

## Development

### Running in Development Mode

```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Watch for asset changes
npm run dev
```

### Building for Production

```bash
# Optimize configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Build assets
npm run build
```

## Seeding Sample Data (Optional)

To populate the database with sample data for testing:

```bash
php artisan db:seed
```

## Troubleshooting

### Issue: Images not displaying

**Solution**: Make sure you've created the storage link:

```bash
php artisan storage:link
```

### Issue: Filament styles not loading

**Solution**: Publish Filament assets:

```bash
php artisan filament:assets
```

### Issue: Permission errors

**Solution**: Set proper permissions:

```bash
chmod -R 775 storage bootstrap/cache
```

## License

This project is open-sourced software licensed under the MIT license.

## Support

For support, please open an issue in the repository or contact the development team.

## Credits

-   Template: Dolt - Medical Health & Dental Care HTML Template
-   Framework: Laravel 12
-   Admin Panel: Filament v3
-   Icons: Remix Icon
-   CSS Framework: Bootstrap 5

---

Made with ❤️ for healthcare professionals
