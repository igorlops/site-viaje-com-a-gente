<?php

namespace App\DTOs\Admin;

use Illuminate\Http\Request;

class ServiceDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $slug,
        public readonly ?string $subtitle,
        public readonly ?string $summary,
        public readonly ?string $content,
        public readonly string $status,
        public readonly bool $show_in_menu,
        public readonly ?string $meta_title,
        public readonly ?string $meta_description,
        public readonly ?string $meta_keywords,
        public readonly ?string $og_title,
        public readonly ?string $og_description,
        public readonly ?string $og_image,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->input('title'),
            slug: $request->input('slug'),
            subtitle: $request->input('subtitle'),
            summary: $request->input('summary'),
            content: $request->input('content'),
            status: $request->input('status', 'draft'),
            show_in_menu: $request->boolean('show_in_menu'),
            meta_title: $request->input('meta_title'),
            meta_description: $request->input('meta_description'),
            meta_keywords: $request->input('meta_keywords'),
            og_title: $request->input('og_title'),
            og_description: $request->input('og_description'),
            og_image: $request->input('og_image'),
        );
    }

    public function toArray(): array
    {
        return [
            'title'            => $this->title,
            'slug'             => $this->slug,
            'subtitle'         => $this->subtitle,
            'summary'          => $this->summary,
            'content'          => $this->content,
            'status'           => $this->status,
            'show_in_menu'     => $this->show_in_menu,
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords'    => $this->meta_keywords,
            'og_title'         => $this->og_title,
            'og_description'   => $this->og_description,
            'og_image'         => $this->og_image,
        ];
    }
}
