<?php

namespace App\Repositories;

use App\DTOs\BannerDTO;
use App\Models\Banner;
use Illuminate\Support\Facades\Log;

class BannerRepository extends BaseRepository
{
    public function __construct(Banner $banner)
    {
        parent::__construct($banner);
    }

    public function store(array $data): void
    {
        $this->model->create($data);
    }

    public function updateBanner(int $id, array $data): void
    {
        $this->update($id, $data);
    }

    public function delete(int $id): void
    {
        $this->delete($id);
    }

    public function find(int $id): ?Banner
    {
        return $this->model->find($id);
    }

    public function findBy(string $field, $value): ?Banner
    {
        return $this->model->where($field, $value)->with('page')->first();
    }

    public function all(): array
    {
        return $this->model->all();
    }

    public function active(): array
    {
        return $this->model->where('active', true)->get();
    }
    public function updateFeature(int $bannerId, array $data): void
    {
        $featureId = $data['id'] ?? null;
        unset($data['id']);

        $this->model->find($bannerId)
            ->featureBanners()
            ->where('id', $featureId)
            ->update($data);
    }

    public function updateButton(int $bannerId, array $data): void
    {
        $buttonId = $data['id'] ?? null;
        unset($data['id']);

        $this->model->find($bannerId)
            ->buttons()
            ->where('id', $buttonId)
            ->update($data);
    }

    public function createFeature(int $bannerId, array $data): void
    {
        $this->model->find($bannerId)->featureBanners()->create($data);
    }
    public function createButton(int $bannerId, array $data): void
    {
        $this->model->find($bannerId)->buttons()->create($data);
    }
    public function deleteFeaturesNotIn(int $bannerId, array $ids): void
    {
        $this->model->find($bannerId)->featureBanners()->whereNotIn('id', $ids)->delete();
    }

    public function deleteButtonsNotIn(int $bannerId, array $ids): void
    {
        $this->model->find($bannerId)->buttons()->whereNotIn('id', $ids)->delete();
    }
}
