<?php

namespace App\Services;

use App\DTOs\ContactDTO;
use App\Repositories\PageRepository;

class PageService
{
    public function __construct(
        protected PageRepository $repository
    ) {}

    /**
     * Handle the contact form submission.
     */
    public function findByPageSlug(string $slug)
    {
        return $this->repository->findBy('slug', $slug);
    }
}
