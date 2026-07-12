<?php

namespace App\DTOs\Admin;

use App\Http\Requests\Admin\TestimonialRequest;

class TestimonialDTO
{
    public function __construct(
        public readonly string  $author_name,
        public readonly ?string $author_role,
        public readonly int     $rating,
        public readonly string  $content,
        public readonly bool    $is_active,
        public readonly ?int    $destination_id,
        public readonly int     $order,
    ) {}

    public static function fromRequest(TestimonialRequest $request): self
    {
        return new self(
            author_name: $request->input('author_name'),
            author_role: $request->input('author_role'),
            rating:      (int) $request->input('rating', 5),
            content:     $request->input('content'),
            is_active:   $request->boolean('is_active'),
            destination_id: $request->input('destination_id'),
            order:       (int) $request->input('order', 0),
        );
    }

    public function toArray(): array
    {
        return [
            'author_name' => $this->author_name,
            'author_role' => $this->author_role,
            'rating'      => $this->rating,
            'content'     => $this->content,
            'is_active'   => $this->is_active,
            'destination_id' => $this->destination_id,
            'order'       => $this->order,
        ];
    }
}
