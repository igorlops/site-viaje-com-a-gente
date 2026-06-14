<?php

namespace App\Repositories;

use App\Models\Destination;
use App\DTOs\DestinationsFilterDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DestinationRepository extends BaseRepository
{
    public function __construct(Destination $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->latest()->get();
    }

    public function getByType(string $type): Collection
    {
        return $this->model->where('type', $type)->latest()->get();
    }

    public function featuredByType(string $type): Collection
    {
        return $this->model->where('type', $type)->where('is_featured', true)->latest()->get();
    }

    public function getFeatured(): Collection
    {
        return $this->model->where('is_featured', true)->latest()->get();
    }

    public function paginateWithFilters(DestinationsFilterDTO $filters): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if ($filters->type) {
            $query->where('type', $filters->type);
        }

        if ($filters->search) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters->search . '%')
                  ->orWhere('subtitle', 'like', '%' . $filters->search . '%')
                  ->orWhere('category', 'like', '%' . $filters->search . '%');
            });
        }

        return $query->latest()->paginate($filters->perPage);
    }
}
