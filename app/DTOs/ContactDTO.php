<?php

namespace App\DTOs;

use App\Http\Requests\ContactRequest;

class ContactDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $phone,
        public readonly string $message,
        public readonly string $type = 'default'
    ) {}

    /**
     * Create a DTO from the validated request.
     */
    public static function fromRequest(ContactRequest $request): self
    {
        return new self(
            name: $request->validated('name'),
            email: $request->validated('email'),
            phone: $request->validated('phone'),
            message: $request->validated('message'),
            type: $request->input('type') ?? 'default'
        );
    }

    /**
     * Convert the DTO to an array.
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
            'type' => $this->type,
        ];
    }
}
