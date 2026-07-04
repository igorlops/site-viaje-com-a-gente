<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class DestinationStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => $this->isMethod('POST') ? 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120' : 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'duration' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'tag' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'whatsapp_link' => 'nullable|url|max:255',
            'type' => 'required|string|in:bate-e-volta,viagem-grupo,pacote-principal,pacotes-2026-2027,viagem-em-grupo',
            'slug' => 'nullable|string|max:255',
            
            // Novos campos adicionados na migration
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'full_price' => 'nullable|string|max:255',
            'date_range' => 'nullable|string|max:255',
            'nights' => 'nullable|string|max:255',
            'departure_date' => 'nullable|string|max:255',
            'return_date' => 'nullable|string|max:255',
            'departure_city' => 'nullable|string|max:255',
            'trip_type' => 'nullable|string|max:255',
            'highlights_icons' => 'nullable|array',
            'highlights_icons.*' => 'nullable|string|max:255',

            // Relações - Includes
            'includes' => 'nullable|array',
            'includes.*.text' => 'required|string|max:255',
            'includes.*.type' => 'required|string|in:included,not_included',
            'includes.*.order' => 'nullable|integer',

            // Relações - Highlights
            'highlights' => 'nullable|array',
            'highlights.*.id' => 'nullable|integer',
            'highlights.*.title' => 'required|string|max:255',
            'highlights.*.subtitle' => 'nullable|string|max:255',
            'highlights.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'highlights.*.order' => 'nullable|integer',

            // Relações - Itinerary (Dia a Dia)
            'itinerary' => 'nullable|array',
            'itinerary.*.id' => 'nullable|integer',
            'itinerary.*.day_number' => 'required|integer|min:1',
            'itinerary.*.date' => 'nullable|string|max:255',
            'itinerary.*.label' => 'required|string|max:255',
            'itinerary.*.order' => 'nullable|integer',
            'itinerary.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'itinerary.*.activities' => 'nullable|array',
            'itinerary.*.activities.*' => 'required|string|max:255',

            // Relações - Observações
            'observations' => 'nullable|array',
            'observations.*.id' => 'nullable|integer',
            'observations.*.text' => 'required|string|max:1000',
            'observations.*.order' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título do destino é obrigatório.',
            'image.required' => 'A imagem ilustrativa é obrigatória para um novo destino.',
            'duration.required' => 'A duração é obrigatória.',
            'category.required' => 'A categoria é obrigatória.',
            'price.required' => 'O preço é obrigatório.',
            'type.required' => 'Selecione o tipo do destino.',
            'type.in' => 'O tipo do destino selecionado é inválido.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('title') && !$this->filled('slug')) {
            $this->merge([
                'slug' => Str::slug($this->input('title'))
            ]);
        }
    }
}
