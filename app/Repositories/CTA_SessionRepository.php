<?php

namespace App\Repositories;

use App\Models\CTA_Session;
use Illuminate\Support\Facades\Log;

class CTA_SessionRepository extends BaseRepository
{
    public function __construct(CTA_Session $cta_session)
    {
        parent::__construct($cta_session);
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

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function findBy(string $field, $value){
        return $this->model->where($field, $value)->with('page','cta_session_list')->get();
    }

    public function all(): array
    {
        return $this->model->all();
    }

    public function active(): array
    {
        return $this->model->where('active', true)->get();
    }
    public function updateCtaSessionListItem(int $itemId, array $data): void
    {
        $this->model->find($itemId)->cta_session_list()->update($data);
    }

    public function createCtaSessionListItem(int $sessionId, array $data): void
    {
        $this->model->find($sessionId)->cta_session_list()->create($data);
    }

    public function deleteCtaSessionListItemNotIn(int $sessionId, array $ids): void
    {
        $this->model->find($sessionId)->cta_session_list()->whereNotIn('id', $ids)->delete();
    }
}
