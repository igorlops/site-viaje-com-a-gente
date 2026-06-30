<?php

namespace App\DTOs\Admin;

use App\Http\Requests\Admin\DestinationStoreRequest;

class DestinationStoreDTO
{
    public function __construct(
        public readonly string $title,
        public readonly ?string $subtitle,
        public readonly string $duration,
        public readonly string $category,
        public readonly float $price,
        public readonly ?string $tag,
        public readonly bool $is_featured,
        public readonly ?string $whatsapp_link,
        public readonly string $type,
        public readonly ?string $slug,
        public readonly ?string $title_card,
        public readonly ?string $subtitle_card,
        public readonly ?string $text_label_banner,
        // Novos campos
        public readonly ?string $full_price,
        public readonly ?string $date_range,
        public readonly ?string $nights,
        public readonly ?string $departure_date,
        public readonly ?string $return_date,
        public readonly ?string $departure_city,
        public readonly ?string $trip_type,
        public readonly ?array $highlights_icons,
        public readonly ?array $includes,
        public readonly ?array $highlights,
        public readonly ?array $itinerary
    ) {}

    public static function fromRequest(DestinationStoreRequest $request): self
    {
        return new self(
            title: $request->input('title'),
            subtitle: $request->input('subtitle'),
            duration: $request->input('duration'),
            category: $request->input('category'),
            price: (float) $request->input('price'),
            tag: $request->input('tag'),
            is_featured: $request->boolean('is_featured'),
            whatsapp_link: $request->input('whatsapp_link'),
            type: $request->input('type'),
            slug: $request->input('slug'),
            
            // Novos campos
            full_price: $request->input('full_price'),
            date_range: $request->input('date_range'),
            nights: $request->input('nights'),
            departure_date: $request->input('departure_date'),
            return_date: $request->input('return_date'),
            departure_city: $request->input('departure_city'),
            trip_type: $request->input('trip_type'),
            highlights_icons: $request->input('highlights_icons'),
            title_card: $request->input('title_card'),
            subtitle_card: $request->input('subtitle_card'),
            text_label_banner: $request->input('text_label_banner'),
            includes: $request->input('includes'),
            highlights: $request->input('highlights'),
            itinerary: $request->input('itinerary')
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'duration' => $this->duration,
            'category' => $this->category,
            'price' => $this->price,
            'tag' => $this->tag,
            'is_featured' => $this->is_featured,
            'whatsapp_link' => $this->whatsapp_link,
            'type' => $this->type,
            'slug' => $this->slug,
            
            // Novos campos
            'title_card' => $this->title_card,
            'subtitle_card' => $this->subtitle_card,
            'text_label_banner' => $this->text_label_banner,
            'full_price' => $this->full_price,
            'date_range' => $this->date_range,
            'nights' => $this->nights,
            'departure_date' => $this->departure_date,
            'return_date' => $this->return_date,
            'departure_city' => $this->departure_city,
            'trip_type' => $this->trip_type,
            'highlights_icons' => $this->highlights_icons,
        ];
    }
}
