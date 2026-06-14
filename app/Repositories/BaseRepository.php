<?php

namespace App\Repositories;

class BaseRepository
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->all();
    }
    public function find(int $id)
    {
        return $this->model->find($id);
    }
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    public function update(int $id, array $data)
    {
        $model = $this->model->find($id);
        $model->update($data);
        return $model;
    }
    public function delete(int $id)
    {
        $model = $this->model->find($id);
        $model->delete();
    }
}