<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageUploadService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    public function upload(UploadedFile $file, string $directory): string
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $relativePath = ltrim($directory, '/') . '/' . $fileName;

        $image = $this->manager->decode($file);

        $this->ensureDirectoriesExist($directory);

        $image->save(public_path('storage/' . $relativePath), quality: 90);
        $image->scale(1920)->save(public_path('storage/grandes/' . $relativePath), quality: 90);
        $image->scale(800)->save(public_path('storage/medias/' . $relativePath), quality: 90);
        $image->scale(400)->save(public_path('storage/pequenas/' . $relativePath), quality: 90);

        return $relativePath;
    }

    public function delete(?string $path): void
    {
        if (!$path) {
            return;
        }

        $paths = [
            $path,
            'grandes/' . $path,
            'medias/' . $path,
            'pequenas/' . $path,
        ];

        foreach ($paths as $p) {
            Storage::disk('public')->delete($p);
        }
    }

    protected function ensureDirectoriesExist(string $directory): void
    {
        $dirClean = ltrim($directory, '/');
        $directories = [
            public_path('storage'),
            public_path('storage/' . $dirClean),
            public_path('storage/grandes/' . $dirClean),
            public_path('storage/medias/' . $dirClean),
            public_path('storage/pequenas/' . $dirClean),
        ];

        foreach ($directories as $dir) {
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
        }
    }
}
