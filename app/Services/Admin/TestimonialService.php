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
