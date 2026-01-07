# Quick Start Guide

## Getting Started in 5 Minutes

### Step 1: Install Dependencies

```bash
cd laravel-clinic
composer install
npm install
```

### Step 2: Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### Step 3: Setup Database

```bash
php artisan migrate
php artisan make:filament-user
```

### Step 4: Create Storage Link

```bash
php artisan storage:link
```

### Step 5: Run the Application

```bash
# Terminal 1
php artisan serve

# Terminal 2 (optional - for asset compilation)
npm run dev
```

## Access Points

-   **Website**: http://localhost:8000
-   **Admin Panel**: http://localhost:8000/admin

## First Steps After Login

1. Go to **Settings** and configure:

    - Site name
    - Contact information
    - Working hours
    - Social media links

2. Add **Services**:

    - Navigate to Services
    - Click "New Service"
    - Fill in details and upload images

3. Add **Doctors**:

    - Navigate to Doctors
    - Click "New Doctor"
    - Add profile information and photos

4. Add **Testimonials**:

    - Navigate to Testimonials
    - Add patient reviews

5. Create **Blog Posts**:
    - Navigate to Posts
    - Write and publish articles

That's it! Your clinic website is ready to use! 🎉
