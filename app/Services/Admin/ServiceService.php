<?php

namespace App\Services\Admin;

use App\DTOs\Admin\ServiceDTO;
use App\Models\Service;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ServiceService
{
    public function __construct(
        private readonly ServiceRepository $repository
    ) {}

    /**
     * Cria um novo serviço com upload de imagens.
     */
    public function create(ServiceDTO $dto, Request $request): Service
    {
        $data = $dto->toArray();

        if ($request->hasFile('banner')) {
            $data['banner_path'] = $this->uploadImage($request->file('banner'), 'services/banners');
        }

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->uploadImage($request->file('image'), 'services/images');
        }

        if ($request->hasFile('og_image')) {
            $data['og_image'] = $this->uploadImage($request->file('og_image'), 'services/og');
        }

        return $this->repository->create($data);
    }

    /**
     * Atualiza um serviço existente com possível troca de imagens.
     */
    public function update(ServiceDTO $dto, Service $service, Request $request)
    {
        $data = $dto->toArray();

        if ($request->hasFile('banner')) {
            $this->deleteOldImage($service->banner_path);
            $data['banner_path'] = $this->uploadImage($request->file('banner'), 'services/banners');
        }

        if ($request->hasFile('image')) {
            $this->deleteOldImage($service->image_path);
            $data['image_path'] = $this->uploadImage($request->file('image'), 'services/images');
        }

        if ($request->hasFile('og_image')) {
            $this->deleteOldImage($service->og_image);
            $data['og_image'] = $this->uploadImage($request->file('og_image'), 'services/og');
        }

        return $this->repository->update($service->id, $data);
    }

    /**
     * Realiza soft delete do serviço e remove imagens do storage.
     */
    public function destroy(Service $service): bool
    {
        // Não removemos imagens no soft delete — apenas na exclusão permanente
        return $this->repository->softDelete($service);
    }

    /**
     * Faz upload de imagem e retorna o path relativo.
     */
    private function uploadImage(UploadedFile $file, string $directory): string
    {
        return $file->store($directory, 'public');
    }

    /**
     * Remove imagem antiga do storage se existir.
     */
    private function deleteOldImage(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
