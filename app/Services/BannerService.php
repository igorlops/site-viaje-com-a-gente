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
        $dataFeature = [];
        $dataButton = [];
        if(isset($data['features'])) {
            foreach ($data['features'] as $feature) {
                $dataFeature[] = $feature;
            }
            unset($data['features']);
        }
        if(isset($data['buttons'])) {
            foreach ($data['buttons'] as $button) {
                $dataButton[] = $button;
            }
            unset($data['buttons']);
        }

        $banner = $this->repository->create($data);

        if(isset($dataFeature)) {
            foreach ($dataFeature as $feature) {
                $this->repository->createFeature($banner->id, $feature);
            }
        }
        if(isset($dataButton)) {
            foreach ($dataButton as $button) {
                $this->repository->createButton($banner->id, $button);
            }
        }
        return $banner;
    }

    public function update(int $id, array $data): void
    {
        $this->syncFeatures($id, $data['features'] ?? []);
        unset($data['features']);

        $this->syncButtons($id, $data['buttons'] ?? []);
        unset($data['buttons']);

        $this->repository->updateBanner($id, $data);
    }

    private function syncFeatures(int $bannerId, array $features): void
    {
        $idsToKeep = [];

        foreach ($features as $feature) {
            if (!empty($feature['id'])) {
                $idsToKeep[] = $feature['id'];
            }
        }

        // Remove quem não veio mais na lista (foi excluído no client-side)
        $this->repository->deleteFeaturesNotIn($bannerId, $idsToKeep);

        foreach ($features as $feature) {
            if (!empty($feature['id'])) {
                $this->repository->updateFeature($bannerId, $feature);
            } else {
                $this->repository->createFeature($bannerId, $feature);
            }
        }
    }

    private function syncButtons(int $bannerId, array $buttons): void
    {
        $idsToKeep = [];

        foreach ($buttons as $button) {
            if (!empty($button['id'])) {
                $idsToKeep[] = $button['id'];
            }
        }

        $this->repository->deleteButtonsNotIn($bannerId, $idsToKeep);

        foreach ($buttons as $button) {
            if (!empty($button['id'])) {
                $this->repository->updateButton($bannerId, $button);
            } else {
                $this->repository->createButton($bannerId, $button);
            }
        }
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
