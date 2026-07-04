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

    public function findById(int $id): ?Service
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // update() removido — agora usa o da BaseRepository, que já está correto

    public function softDelete(int $id)
    {
        $model = $this->model->find($id);
        return $model->delete();
    }

    public function count(): int
    {
        return $this->model->count();
    }
}