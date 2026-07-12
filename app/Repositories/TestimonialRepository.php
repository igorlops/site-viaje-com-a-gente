<?php

namespace App\Repositories;

use App\Models\Testimonial;
use Illuminate\Support\Collection;

class TestimonialRepository extends BaseRepository
{
    public function __construct(Testimonial $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->orderBy('order')->get();
    }

    public function allActive(): Collection
    {
        return $this->model->active()->get();
    }

    public function allActiveGlobal(): Collection
    {
        return $this->model->active()->whereNull('destination_id')->get();
    }

    public function allActiveForDestination(int $destinationId): Collection
    {
        return $this->model->active()->where('destination_id', $destinationId)->get();
    }
}
