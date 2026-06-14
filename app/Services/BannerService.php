<?php

namespace App\Services;

use App\DTOs\ContactDTO;
use App\Repositories\BannerRepository;

class BannerService
{
    public function __construct(
        protected BannerRepository $repository,
        protected PageService $pageService
    ) {}

    /**
     * Handle the contact form submission.
     */
    public function bannerByPageSlug(string $slug)
    {
        $pageId = $this->pageService->findByPageSlug($slug);
        return $this->repository->findBy('page_id', $pageId);
    }

    public function createFeatureBanner($data) {
        
    }
    public function create($data) {
        if(isset($data['features'])) {
            foreach ($data['features'] as $feature) {
                $this->repository->createFeature($data['id'], $feature);
            }
            unset($data['features']);
        }
        if(isset($data['buttons'])) {
            foreach ($data['buttons'] as $button) {
                $this->repository->createButton($data['id'], $button);
            }
            unset($data['buttons']);
        }
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): void
    {
        if(isset($data['features'])) {
            foreach ($data['features'] as $feature) {
                if(isset($feature['id'])) {
                    $this->repository->updateFeature($id, $feature);
                } else {
                    $this->repository->createFeature($id, $feature);
                }
            }
            unset($data['features']);
        }
        if(isset($data['buttons'])) {
            foreach ($data['buttons'] as $button) {
                if(isset($button['id'])) {
                    $this->repository->updateButton($id, $button);
                } else {
                    $this->repository->createButton($id, $button);
                }
            }
            unset($data['buttons']);
        }
        $this->repository->updateBanner($id, $data);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
    public function find(int $id)
    {
        return $this->repository->find($id);
    }
}
