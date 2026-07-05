<?php

namespace App\Repositories;

use App\Models\Faq;
use Illuminate\Support\Collection;

class FaqRepository extends BaseRepository
{
    public function __construct(Faq $faq)
    {
        parent::__construct($faq);
    }
    
    public function all(): Collection
    {
        return $this->model->orderBy('order')->get();
    }

    public function findById(int $id): ?Faq
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function count(): int
    {
        return $this->model->count();
    }
}
