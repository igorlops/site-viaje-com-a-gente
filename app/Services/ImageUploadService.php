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

        $image = $this->manager->read($file->getRealPath());

        $this->ensureDirectoriesExist($directory);

        $image->scale(width: 1920);
        $image->toJpeg(90)->save(storage_path('app/public/grandes/' . $relativePath));

        $image->scale(width: 800);
        $image->toJpeg(90)->save(storage_path('app/public/medias/' . $relativePath));

        $image->scale(width: 400);
        $image->toJpeg(90)->save(storage_path('app/public/pequenas/' . $relativePath));

        return $relativePath;
    }

    public function delete(?string $path): void
    {
        if (!$path) {
            return;
        }

        $paths = [
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
        $directories = [
            storage_path('app/public/grandes/' . ltrim($directory, '/')),
            storage_path('app/public/medias/' . ltrim($directory, '/')),
            storage_path('app/public/pequenas/' . ltrim($directory, '/')),
        ];

        foreach ($directories as $dir) {
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
        }
    }
}
