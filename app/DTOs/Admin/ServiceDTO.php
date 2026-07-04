<?php

namespace App\DTOs\Admin;

use Illuminate\Http\Request;

class ServiceDTO
{
    public function __construct(
        public readonly string $title,
        public readonly ?string $subtitle,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->input('title'),
            subtitle: $request->input('subtitle'),

        );
    }

    public function toArray(): array
    {
        return [
            'title'            => $this->title,
            'subtitle'         => $this->subtitle,
        ];
    }
}
