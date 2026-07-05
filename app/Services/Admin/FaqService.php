<?php

namespace App\Services\Admin;

use App\DTOs\Admin\FaqDTO;
use App\Models\Faq;
use App\Repositories\FaqRepository;

class FaqService
{
    public function __construct(
        private readonly FaqRepository $repository
    ) {}

    public function create(FaqDTO $dto): Faq
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, FaqDTO $dto): Faq
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function destroy(int $id): void
    {
        $this->repository->delete($id);
    }
}
