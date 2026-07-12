<?php

namespace App\Services\Admin;

use App\DTOs\Admin\TestimonialDTO;
use App\Models\Testimonial;
use App\Repositories\TestimonialRepository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TestimonialService
{
    public function __construct(
        protected TestimonialRepository $repository
    ) {}

    public function create(TestimonialDTO $dto, Request $request): Testimonial
    {
        $data = $dto->toArray();

        if ($request->hasFile('author_photo')) {
            $data['author_photo'] = $this->uploadPhoto($request->file('author_photo'));
        }

        return $this->repository->create($data);
    }

    public function update(int $id, TestimonialDTO $dto, Request $request): Testimonial
    {
        $data        = $dto->toArray();
        $testimonial = $this->repository->find($id);

        if ($request->hasFile('author_photo')) {
            $this->deleteOldPhoto($testimonial->author_photo);
            $data['author_photo'] = $this->uploadPhoto($request->file('author_photo'));
        }

        return $this->repository->update($id, $data);
    }

    public function destroy(int $id): void
    {
        $testimonial = $this->repository->find($id);
        $this->deleteOldPhoto($testimonial->author_photo);
        $this->repository->delete($id);
    }

    public function duplicate(int $id): void
    {
        $original = $this->repository->find($id);

        $data = $original->toArray();
        unset($data['id'], $data['created_at'], $data['updated_at'], $data['deleted_at']);

        // Ajustar título
        $data['author_name'] = $original->author_name . ' (Cópia)';

        // Duplicar imagem
        if ($original->author_photo && Storage::disk('public')->exists($original->author_photo)) {
            $ext = pathinfo($original->author_photo, PATHINFO_EXTENSION);
            $newPath = 'testimonials/images/' . uniqid() . '.' . $ext;
            Storage::disk('public')->copy($original->author_photo, $newPath);
            $data['author_photo'] = $newPath;
        }
        
        $this->repository->create($data);
    }

    protected function uploadPhoto(UploadedFile $file): string
    {
        return $file->store('testimonials', 'public');
    }

    protected function deleteOldPhoto(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
