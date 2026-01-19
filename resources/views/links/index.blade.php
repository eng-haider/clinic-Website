<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $clinicName }} - {{ __('Links') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 680px;
            width: 100%;
            margin: 0 auto;
        }

        .profile-card {
            text-align: center;
            animation: fadeInDown 0.6s ease-out;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            border: 4px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            object-fit: cover;
            background: white;
            padding: 10px;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .profile-name {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-description {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .links-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .link-item {
            background: white;
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            text-decoration: none;
            color: #1a202c;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 0.6s ease-out backwards;
        }

        .link-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            background: #f7fafc;
        }

        .link-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .link-content {
            flex: 1;
            text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }};
        }

        .link-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.25rem;
        }

        .link-description {
            font-size: 0.875rem;
            color: #718096;
        }

        .link-arrow {
            font-size: 1.25rem;
            color: #a0aec0;
            transition: transform 0.3s ease;
        }

        .link-item:hover .link-arrow {
            transform: translateX({{ app()->getLocale() == 'ar' ? '-4px' : '4px' }});
        }

        /* Platform specific colors */
        .link-item[data-platform="facebook"] .link-icon {
            background: linear-gradient(135deg, #1877f2 0%, #0c63d4 100%);
        }

        .link-item[data-platform="instagram"] .link-icon {
            background: linear-gradient(135deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
        }

        .link-item[data-platform="twitter"] .link-icon,
        .link-item[data-platform="x"] .link-icon {
            background: linear-gradient(135deg, #1da1f2 0%, #0d8bd9 100%);
        }

        .link-item[data-platform="linkedin"] .link-icon {
            background: linear-gradient(135deg, #0077b5 0%, #005885 100%);
        }

        .link-item[data-platform="youtube"] .link-icon {
            background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%);
        }

        .link-item[data-platform="tiktok"] .link-icon {
            background: linear-gradient(135deg, #000000 0%, #333333 100%);
        }

        .link-item[data-platform="whatsapp"] .link-icon {
            background: linear-gradient(135deg, #25d366 0%, #20ba5a 100%);
        }

        .link-item[data-platform="telegram"] .link-icon {
            background: linear-gradient(135deg, #0088cc 0%, #006699 100%);
        }

        .link-item[data-platform="snapchat"] .link-icon {
            background: linear-gradient(135deg, #fffc00 0%, #e6e600 100%);
            color: #000;
        }

        .footer {
            text-align: center;
            margin-top: 3rem;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.875rem;
        }

        .footer a {
            color: white;
            text-decoration: underline;
            font-weight: 600;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Stagger animation for links */
        .link-item:nth-child(1) { animation-delay: 0.1s; }
        .link-item:nth-child(2) { animation-delay: 0.2s; }
        .link-item:nth-child(3) { animation-delay: 0.3s; }
        .link-item:nth-child(4) { animation-delay: 0.4s; }
        .link-item:nth-child(5) { animation-delay: 0.5s; }
        .link-item:nth-child(6) { animation-delay: 0.6s; }
        .link-item:nth-child(7) { animation-delay: 0.7s; }
        .link-item:nth-child(8) { animation-delay: 0.8s; }
        .link-item:nth-child(9) { animation-delay: 0.9s; }
        .link-item:nth-child(10) { animation-delay: 1.0s; }
        .link-item:nth-child(11) { animation-delay: 1.1s; }
        .link-item:nth-child(12) { animation-delay: 1.2s; }
        .link-item:nth-child(13) { animation-delay: 1.3s; }
        .link-item:nth-child(14) { animation-delay: 1.4s; }
        .link-item:nth-child(15) { animation-delay: 1.5s; }
        .link-item:nth-child(16) { animation-delay: 1.6s; }
        .link-item:nth-child(17) { animation-delay: 1.7s; }
        .link-item:nth-child(18) { animation-delay: 1.8s; }
        .link-item:nth-child(19) { animation-delay: 1.9s; }
        .link-item:nth-child(20) { animation-delay: 2.0s; }

        @media (max-width: 640px) {
            .profile-name {
                font-size: 1.5rem;
            }

            .link-item {
                padding: 1rem 1.25rem;
            }

            .link-icon {
                width: 40px;
                height: 40px;
                font-size: 1.25rem;
            }

            .link-title {
                font-size: 1rem;
            }
        }

        /* RTL Support */
        [dir="rtl"] .link-item:hover .link-arrow {
            transform: translateX(-4px);
        }

        [dir="ltr"] .link-item:hover .link-arrow {
            transform: translateX(4px);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-card">
            <!-- Profile Image -->
            <div class="profile-image">
                @if($clinicLogo)
                    <img src="{{ $clinicLogo }}" alt="{{ $clinicName }}">
                @else
                    <i class="fas fa-tooth" style="font-size: 3rem; color: #667eea; line-height: 96px;"></i>
                @endif
            </div>

            <!-- Profile Info -->
            <h1 class="profile-name">{{ $clinicName }}</h1>
            <p class="profile-description">{{ $clinicDescription }}</p>

            <!-- Links -->
            <div class="links-container">
                @forelse($links as $link)
                    <a href="{{ $link->url }}" 
                       class="link-item" 
                       data-platform="{{ $link->platform ?? 'custom' }}"
                       target="_blank" 
                       rel="noopener noreferrer">
                        <div class="link-icon">
                            @if($link->icon)
                                <i class="{{ $link->icon }}"></i>
                            @else
                                <i class="fas fa-link"></i>
                            @endif
                        </div>
                        <div class="link-content">
                            <div class="link-title">{{ $link->title }}</div>
                            @if($link->description)
                                <div class="link-description">{{ $link->description }}</div>
                            @endif
                        </div>
                        <div class="link-arrow">
                            <i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                        </div>
                    </a>
                @empty
                    <div class="link-item" style="opacity: 0.7; cursor: default;">
                        <div class="link-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="link-content">
                            <div class="link-title">{{ __('No links available yet') }}</div>
                            <div class="link-description">{{ __('Check back soon!') }}</div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ $clinicName }}. {{ __('All rights reserved.') }}</p>
        </div>
    </div>
</body>
</html>
