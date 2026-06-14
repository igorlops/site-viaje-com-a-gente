<?php

namespace App\Services;

use App\DTOs\ContactDTO;
use App\Repositories\ContactRepository;

class ContactService
{
    public function __construct(
        protected ContactRepository $repository
    ) {}

    /**
     * Handle the contact form submission.
     */
    public function handle(ContactDTO $dto): void
    {
        // Execute repository storage logic
        $this->repository->store($dto);

        // Additional actions like sending emails can be added here in the future
    }
}
