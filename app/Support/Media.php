<?php

namespace App\Support;

class Media
{
    public static function url(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'uploads/')) {
            return asset('storage/'.$path);
        }

        return asset($path);
    }

    public static function display(?string $path): ?string
    {
        $webp = self::webpPath($path);

        if ($webp !== null && is_file(self::absolutePath($webp))) {
            return self::url($webp);
        }

        return self::url($path);
    }

    public static function writeWebp(?string $path): void
    {
        if ($path === null || ! function_exists('imagewebp')) {
            return;
        }

        $source = self::absolutePath($path);
        $target = self::absolutePath((string) self::webpPath($path));

        if ($source === null || $target === null || ! is_file($source)) {
            return;
        }

        $info = @getimagesize($source);
        $image = match ($info['mime'] ?? '') {
            'image/jpeg' => @imagecreatefromjpeg($source),
            'image/png' => @imagecreatefrompng($source),
            'image/webp' => @imagecreatefromwebp($source),
            default => false,
        };

        if ($image === false) {
            return;
        }

        $width = imagesx($image);
        $height = imagesy($image);
        $maxEdge = 1400;

        if ($width > $maxEdge || $height > $maxEdge) {
            $scale = $maxEdge / max($width, $height);
            $newWidth = max(1, (int) round($width * $scale));
            $newHeight = max(1, (int) round($height * $scale));
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            $transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
            imagefilledrectangle($resized, 0, 0, $newWidth, $newHeight, $transparent);
            imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagedestroy($image);
            $image = $resized;
        }

        imagewebp($image, $target, 78);
        imagedestroy($image);
    }

    public static function absolutePath(?string $path): ?string
    {
        if ($path === null || $path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return null;
        }

        if (str_starts_with($path, 'uploads/')) {
            return storage_path('app/public/'.$path);
        }

        return public_path($path);
    }

    public static function webpPath(?string $path): ?string
    {
        if ($path === null || $path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return null;
        }

        $webp = preg_replace('/\.(png|jpe?g)$/i', '.webp', $path);

        return $webp === $path ? null : $webp;
    }
}
