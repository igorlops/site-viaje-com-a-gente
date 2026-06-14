<?php

namespace App\Services;

use App\DTOs\DestinationsFilterDTO;
use App\Repositories\DestinationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DestinationService
{
    public function __construct(
        protected DestinationRepository $repository
    ) {}

    /**
     * Paginate destinations based on filter DTO.
     */
    public function paginate(DestinationsFilterDTO $filters): LengthAwarePaginator
    {
        return $this->repository->paginateWithFilters($filters);
    }
}
