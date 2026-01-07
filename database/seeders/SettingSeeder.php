<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Contact Information
            [
                'key' => 'clinic_name',
                'value' => 'Smile Dental Clinic',
                'type' => 'text',
                'group' => 'general',
            ],
            [
                'key' => 'clinic_email',
                'value' => 'info@smiledentalclinic.com',
                'type' => 'email',
                'group' => 'contact',
            ],
            [
                'key' => 'clinic_phone',
                'value' => '+1 (555) 123-4567',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'clinic_address',
                'value' => '123 Dental Street, Suite 100, New York, NY 10001',
                'type' => 'textarea',
                'group' => 'contact',
            ],
            
            // Business Hours
            [
                'key' => 'hours_monday',
                'value' => '9:00 AM - 6:00 PM',
                'type' => 'text',
                'group' => 'hours',
            ],
            [
                'key' => 'hours_tuesday',
                'value' => '9:00 AM - 6:00 PM',
                'type' => 'text',
                'group' => 'hours',
            ],
            [
                'key' => 'hours_wednesday',
                'value' => '9:00 AM - 6:00 PM',
                'type' => 'text',
                'group' => 'hours',
            ],
            [
                'key' => 'hours_thursday',
                'value' => '9:00 AM - 6:00 PM',
                'type' => 'text',
                'group' => 'hours',
            ],
            [
                'key' => 'hours_friday',
                'value' => '9:00 AM - 5:00 PM',
                'type' => 'text',
                'group' => 'hours',
            ],
            [
                'key' => 'hours_saturday',
                'value' => '10:00 AM - 3:00 PM',
                'type' => 'text',
                'group' => 'hours',
            ],
            [
                'key' => 'hours_sunday',
                'value' => 'Closed',
                'type' => 'text',
                'group' => 'hours',
            ],
            
            // Social Media
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/smiledentalclinic',
                'type' => 'url',
                'group' => 'social',
            ],
            [
                'key' => 'social_twitter',
                'value' => 'https://twitter.com/smiledentalclinic',
                'type' => 'url',
                'group' => 'social',
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/smiledentalclinic',
                'type' => 'url',
                'group' => 'social',
            ],
            [
                'key' => 'social_linkedin',
                'value' => 'https://linkedin.com/company/smiledentalclinic',
                'type' => 'url',
                'group' => 'social',
            ],
            [
                'key' => 'social_youtube',
                'value' => 'https://youtube.com/@smiledentalclinic',
                'type' => 'url',
                'group' => 'social',
            ],
            
            // About Section
            [
                'key' => 'about_title',
                'value' => 'Welcome to Smile Dental Clinic',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about_description',
                'value' => 'We are committed to providing the highest quality dental care in a comfortable, caring environment. Our team of experienced professionals uses the latest technology and techniques to ensure your smile is healthy and beautiful.',
                'type' => 'textarea',
                'group' => 'about',
            ],
            
            // SEO
            [
                'key' => 'meta_description',
                'value' => 'Smile Dental Clinic offers comprehensive dental services including general dentistry, cosmetic procedures, orthodontics, and more. Book your appointment today!',
                'type' => 'textarea',
                'group' => 'seo',
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'dental clinic, dentist, teeth cleaning, dental implants, orthodontics, cosmetic dentistry',
                'type' => 'text',
                'group' => 'seo',
            ],
            
            // Emergency Contact
            [
                'key' => 'emergency_phone',
                'value' => '+1 (555) 999-8888',
                'type' => 'text',
                'group' => 'emergency',
            ],
            [
                'key' => 'emergency_text',
                'value' => 'For dental emergencies after hours, please call our emergency hotline.',
                'type' => 'textarea',
                'group' => 'emergency',
            ],
            
            // Features
            [
                'key' => 'feature_1_title',
                'value' => 'Expert Dentists',
                'type' => 'text',
                'group' => 'features',
            ],
            [
                'key' => 'feature_1_description',
                'value' => 'Our team consists of highly qualified and experienced dental professionals.',
                'type' => 'textarea',
                'group' => 'features',
            ],
            [
                'key' => 'feature_2_title',
                'value' => 'Modern Equipment',
                'type' => 'text',
                'group' => 'features',
            ],
            [
                'key' => 'feature_2_description',
                'value' => 'We use state-of-the-art technology for accurate diagnosis and treatment.',
                'type' => 'textarea',
                'group' => 'features',
            ],
            [
                'key' => 'feature_3_title',
                'value' => 'Affordable Prices',
                'type' => 'text',
                'group' => 'features',
            ],
            [
                'key' => 'feature_3_description',
                'value' => 'Quality dental care at competitive prices with flexible payment options.',
                'type' => 'textarea',
                'group' => 'features',
            ],
            [
                'key' => 'feature_4_title',
                'value' => 'Emergency Care',
                'type' => 'text',
                'group' => 'features',
            ],
            [
                'key' => 'feature_4_description',
                'value' => '24/7 emergency dental services for urgent dental problems.',
                'type' => 'textarea',
                'group' => 'features',
            ],
            
            // Patient Lookup Settings
            [
                'key' => 'patient_lookup_bg',
                'value' => 'assets/img/hero/hero-img-2.webp',
                'type' => 'image',
                'group' => 'patient_lookup',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
