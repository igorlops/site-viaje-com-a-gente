<?php

namespace App\Repositories;

use App\DTOs\ContactDTO;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;

class ContactRepository extends BaseRepository
{
    public function __construct(Contact $contact)
    {
        parent::__construct($contact);
    }
    /**
     * Store the contact form message.
     */
    public function store(ContactDTO $dto): void
    {
        // Logs the submission details. Ready to be mapped to a DB table if needed later.
        $this->create($dto->toArray());
    }
}
