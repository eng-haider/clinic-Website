<?php

if (!function_exists('doctor_image')) {
    function doctor_image($filename) {
        if (!$filename) {
            return asset('assets/img/team/team-1.webp');
        }
        return asset('assets/img/team/' . $filename);
    }
}

if (!function_exists('service_image')) {
    function service_image($filename) {
        if (!$filename) {
            return asset('assets/img/services/service-1.webp');
        }
        return asset('assets/img/services/' . $filename);
    }
}

if (!function_exists('blog_image')) {
    function blog_image($filename) {
        if (!$filename) {
            return asset('assets/img/blog/blog-1.webp');
        }
        return asset('assets/img/blog/' . $filename);
    }
}

if (!function_exists('client_image')) {
    function client_image($filename) {
        if (!$filename) {
            return asset('assets/img/clients/client-1.webp');
        }
        return asset('assets/img/clients/' . $filename);
    }
}
