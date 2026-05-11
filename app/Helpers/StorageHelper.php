<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StorageHelper
{
    public static function upload(UploadedFile $file, string $folder = 'uploads'): string
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $folder . '/' . $filename;
        Storage::disk('e2e')->put($path, file_get_contents($file), 'public');
        return $path;
    }

    public static function url(string $path): string
    {
        if (empty($path)) return '';
        if (str_starts_with($path, 'http')) return $path;
        $endpoint = rtrim(config('filesystems.disks.e2e.endpoint', ''), '/');
        $bucket   = config('filesystems.disks.e2e.bucket', '');
        return "{$endpoint}/{$bucket}/{$path}";
    }

    public static function delete(string $path): void
    {
        if (!empty($path) && !str_starts_with($path, 'http')) {
            Storage::disk('e2e')->delete($path);
        }
    }
}
