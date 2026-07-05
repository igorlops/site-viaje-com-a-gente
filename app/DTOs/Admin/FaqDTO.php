<?php

namespace App\DTOs\Admin;

use App\Http\Requests\Admin\FaqRequest;

class FaqDTO
{
    public function __construct(
        public readonly string $question,
        public readonly string $answer,
        public readonly int $order
    ) {}

    public static function fromRequest(FaqRequest $request): self
    {
        return new self(
            question: $request->input('question'),
            answer: $request->input('answer'),
            order: (int) $request->input('order', 0)
        );
    }

    public function toArray(): array
    {
        return [
            'question' => $this->question,
            'answer' => $this->answer,
            'order' => $this->order,
        ];
    }
}
