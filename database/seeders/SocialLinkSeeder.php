<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            [
                'title' => 'Facebook',
                'url' => 'https://facebook.com/yourclinic',
                'icon' => 'fab fa-facebook',
                'platform' => 'facebook',
                'description' => 'Follow us for daily updates',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Instagram',
                'url' => 'https://instagram.com/yourclinic',
                'icon' => 'fab fa-instagram',
                'platform' => 'instagram',
                'description' => 'See our before & after results',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'WhatsApp',
                'url' => 'https://wa.me/1234567890',
                'icon' => 'fab fa-whatsapp',
                'platform' => 'whatsapp',
                'description' => 'Chat with us directly',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Book Appointment',
                'url' => url('/book-appointment'),
                'icon' => 'fas fa-calendar-check',
                'platform' => 'custom',
                'description' => 'Schedule your visit today',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Our Website',
                'url' => url('/'),
                'icon' => 'fas fa-globe',
                'platform' => 'website',
                'description' => 'Visit our full website',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'YouTube',
                'url' => 'https://youtube.com/@yourclinic',
                'icon' => 'fab fa-youtube',
                'platform' => 'youtube',
                'description' => 'Watch our dental care tips',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($links as $link) {
            SocialLink::create($link);
        }
    }
}
