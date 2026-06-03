<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CasePhotoProxyController extends Controller
{
    /**
     * The only remote location we are willing to proxy. Locking this down
     * keeps the endpoint from being abused as an open proxy (SSRF).
     */
    private const SOURCE_BASE = 'https://smartclinicv5.tctate.com/case_photo/';

    /**
     * Serve a patient case photo from our own origin, re-encoded as a
     * standard 3-channel RGB JPEG.
     *
     * Some case photos (dental X-rays) come back as single-channel grayscale
     * JPEGs. Those decode fine as a normal <img>, but render as a solid black
     * frame inside GPU-composited viewers (e.g. the Fancybox zoom layer) on
     * certain devices/GPUs. Re-encoding to RGB looks identical and fixes that.
     */
    public function show(string $filename)
    {
        // Hard whitelist: no path traversal, no arbitrary URLs.
        if (!preg_match('/^[A-Za-z0-9_\-]+\.(jpe?g|png)$/i', $filename)) {
            abort(404);
        }

        // Serve an already-converted copy when we have one cached.
        $cachePath = storage_path('app/case-photo-cache/' . md5($filename) . '.jpg');
        if (is_file($cachePath)) {
            return $this->jpegResponse((string) file_get_contents($cachePath));
        }

        try {
            $response = Http::withOptions(['verify' => false])
                ->timeout(20)
                ->get(self::SOURCE_BASE . $filename);

            if (!$response->successful()) {
                abort($response->status() === 404 ? 404 : 502);
            }

            $original = $response->body();
            $converted = $this->toRgbJpeg($original);

            // Best-effort cache of the converted image.
            if ($converted !== null) {
                @mkdir(dirname($cachePath), 0775, true);
                @file_put_contents($cachePath, $converted);
            }

            // Always return something usable: converted when possible,
            // otherwise the untouched bytes so images never break.
            return $this->jpegResponse($converted ?? $original);
        } catch (\Throwable $e) {
            abort(502);
        }
    }

    /**
     * Force the image into a truecolor (3-channel) RGB JPEG.
     * Returns null if GD is unavailable or the source can't be decoded.
     */
    private function toRgbJpeg(string $bytes): ?string
    {
        if (!function_exists('imagecreatefromstring')) {
            return null;
        }

        $src = @imagecreatefromstring($bytes);
        if ($src === false) {
            return null;
        }

        $width = imagesx($src);
        $height = imagesy($src);

        $dst = imagecreatetruecolor($width, $height);
        // Flatten onto white so any transparency/odd source stays sane.
        imagefilledrectangle($dst, 0, 0, $width, $height, imagecolorallocate($dst, 255, 255, 255));
        imagecopy($dst, $src, 0, 0, 0, 0, $width, $height);

        ob_start();
        $ok = imagejpeg($dst, null, 90);
        $out = ob_get_clean();

        imagedestroy($src);
        imagedestroy($dst);

        return $ok ? $out : null;
    }

    private function jpegResponse(string $body)
    {
        return response($body, 200)
            ->header('Content-Type', 'image/jpeg')
            ->header('Cache-Control', 'public, max-age=31536000, immutable');
    }
}
