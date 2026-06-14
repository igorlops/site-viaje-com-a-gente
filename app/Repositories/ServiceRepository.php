<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Support\Collection;

class ServiceRepository extends BaseRepository
{
    public function __construct(Service $service)
    {
        parent::__construct($service);
    }
    
    public function all(): Collection
    {
        return $this->model->all();
    }

    public function allWithTrashed(): Collection
    {
        return $this->model->withTrashed()->latest()->get();
    }

    public function published(): Collection
    {
        return $this->model->published()->orderBy('title')->get();
    }

    public function inMenu(): Collection
    {
        return $this->model->inMenu()->orderBy('title')->get(['id', 'title', 'slug']);
    }

    public function findBySlug(string $slug): ?Service
    {
        return $this->model->published()->where('slug', $slug)->first();
    }

    public function findById(int $id): ?Service
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->model->update($data);
    }

    public function softDelete(int $id)
    {
        return $this->model->delete();
    }

    public function count(): int
    {
        return $this->model->count();
    }

    public function countPublished(): int
    {
        return $this->model->published()->count();
    }
}
