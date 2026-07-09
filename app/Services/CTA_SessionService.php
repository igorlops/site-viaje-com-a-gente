<?php

namespace App\Services;

use App\DTOs\ContactDTO;
use App\Repositories\CTA_SessionRepository;

class   CTA_SessionService
{
    public function __construct(
        protected CTA_SessionRepository $repository,
        protected PageService $pageService
    ) {}

    /**
     * Handle the contact form submission.
     */
    public function CTA_SessionByPageSlug(string $slug)
    {
        $pageId = $this->pageService->findByPageSlug($slug);
        $cta_session = $this->repository->findBy('page_id', $pageId);
        $countCtaSessions = count($cta_session);
        return [$cta_session,$countCtaSessions];
    }

    

    public function update(int $id, array $data): void
    {
        $this->syncFeatures($id, $data['features'] ?? []);
        unset($data['features']);

        $this->syncButtons($id, $data['buttons'] ?? []);
        unset($data['buttons']);

        $this->repository->update($id, $data);
    }

    private function syncFeatures(int $cta_sessionId, array $features): void
    {
        $idsToKeep = [];

        foreach ($features as $feature) {
            if (!empty($feature['id'])) {
                $idsToKeep[] = $feature['id'];
            }
        }

        // Remove quem não veio mais na lista (foi excluído no client-side)
        $this->repository->deleteFeaturesNotIn($cta_sessionId, $idsToKeep);

        foreach ($features as $feature) {
            if (!empty($feature['id'])) {
                $this->repository->updateFeature($cta_sessionId, $feature);
            } else {
                $this->repository->createFeature($cta_sessionId, $feature);
            }
        }
    }

    private function syncButtons(int $cta_sessionId, array $buttons): void
    {
        $idsToKeep = [];

        foreach ($buttons as $button) {
            if (!empty($button['id'])) {
                $idsToKeep[] = $button['id'];
            }
        }

        $this->repository->deleteButtonsNotIn($cta_sessionId, $idsToKeep);

        foreach ($buttons as $button) {
            if (!empty($button['id'])) {
                $this->repository->updateButton($cta_sessionId, $button);
            } else {
                $this->repository->createButton($cta_sessionId, $button);
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
