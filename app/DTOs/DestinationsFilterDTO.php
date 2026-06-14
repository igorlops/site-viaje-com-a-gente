<?php

namespace App\DTOs;

use App\Http\Requests\DestinationsFilterRequest;

class DestinationsFilterDTO
{
    public function __construct(
        public readonly ?string $search,
        public readonly ?string $type,
        public readonly int $perPage = 12
    ) {}

    /**
     * Create DTO from request.
     */
    public static function fromRequest(DestinationsFilterRequest $request): self
    {
        return new self(
            search: $request->query('search'),
            type: $request->query('type'),
            perPage: (int) $request->query('limit', 12)
        );
    }
}
