<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadedMedia
{
    public static function store(UploadedFile $file, string $folder): string
    {
        $path = $file->store('uploads/'.$folder, 'public');
        Media::writeWebp($path);

        return $path;
    }

    public static function deleteIfUploaded(?string $path): void
    {
        if (! $path || ! str_starts_with($path, 'uploads/')) {
            return;
        }

        $disk = Storage::disk('public');

        if ($disk->exists($path)) {
            $disk->delete($path);
        }

        $webp = Media::webpPath($path);

        if ($webp && $disk->exists($webp)) {
            $disk->delete($webp);
        }
    }
}
