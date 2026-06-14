<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository extends BaseRepository
{
    public function __construct(Page $page)
    {
        parent::__construct($page);
    }

    public function store(array $data): void
    {
        $this->model->create($data);
    }

    public function update(int $id, array $data): void
    {
        $this->model->update($id, $data);
    }

    public function delete(int $id): void
    {
        $this->model->delete($id);
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function findBy(string $field, $value)
    {
        return $this->model->where($field, $value)->pluck('id')->first();
    }

    public function all(): array
    {
        return $this->model->all();
    }

    public function active()
    {
        return $this->model->where('active', true)->get();
    }
}
