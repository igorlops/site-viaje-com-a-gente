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
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => $this->isMethod('POST') ? 'nullable|image|mimes:jpeg,png,jpg,gif,webp' : 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'duration' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'tag' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'whatsapp_link' => 'nullable|url|max:255',
            'type' => 'nullable|string|in:bate-e-volta,viagem-grupo,pacotes,viagem-em-grupo',
            'slug' => 'nullable|string|max:255',
            
            // Novos campos adicionados na migration
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
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
            'includes.*.text' => 'nullable|string|max:255',
            'includes.*.type' => 'nullable|string|in:included,not_included',
            'includes.*.order' => 'nullable|integer',

            // Relações - Highlights
            'highlights' => 'nullable|array',
            'highlights.*.id' => 'nullable|integer',
            'highlights.*.title' => 'nullable|string|max:255',
            'highlights.*.subtitle' => 'nullable|string|max:255',
            'highlights.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'highlights.*.order' => 'nullable|integer',

            // Relações - Itinerary (Dia a Dia)
            'itinerary' => 'nullable|array',
            'itinerary.*.id' => 'nullable|integer',
            'itinerary.*.day_number' => 'nullable|integer|min:1',
            'itinerary.*.date' => 'nullable|string|max:255',
            'itinerary.*.label' => 'nullable|string|max:255',
            'itinerary.*.order' => 'nullable|integer',
            'itinerary.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'itinerary.*.activities' => 'nullable|array',
            'itinerary.*.activities.*' => 'nullable|string|max:255',

            // Relações - Observações
            'observations' => 'nullable|array',
            'observations.*.id' => 'nullable|integer',
            'observations.*.text' => 'nullable|string|max:1000',
            'observations.*.order' => 'nullable|integer',

            // Relações - Formas de Pagamento
            'payment_methods' => 'nullable|array',
            'payment_methods.*.payment_method_id' => 'nullable|integer',
            'payment_methods.*.text' => 'nullable|string|max:1000',
            'payment_methods.*.subtext' => 'nullable|string|max:1000',
            'payment_methods.*.order' => 'nullable|integer',
            'payment_methods.*.active' => 'nullable',

            'testimonials' => 'nullable|array',
            'testimonials.*.id' => 'nullable|integer',
            'testimonials.*.author_name' => 'nullable|string|max:255',
            'testimonials.*.author_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'testimonials.*.content' => 'nullable|string',
            'testimonials.*.rating' => 'nullable|integer|min:1|max:5',
            'testimonials.*.destination_id' => 'nullable|exists:destinations,id',
            'testimonials.*.is_active' => 'boolean',
            'testimonials.*.order' => 'nullable|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'title.nullable' => 'O título do destino é obrigatório.',
            'image.nullable' => 'A imagem ilustrativa é obrigatória para um novo destino.',
            'duration.nullable' => 'A duração é obrigatória.',
            'category.nullable' => 'A categoria é obrigatória.',
            'price.nullable' => 'O preço é obrigatório.',
            'type.nullable' => 'Selecione o tipo do destino.',
            'type.in' => 'O tipo do destino selecionado é inválido.',

            'testimonials.*.author_name.nullable' => 'O nome do autor é obrigatório.',
            'testimonials.*.content.nullable' => 'O conteúdo do depoimento é obrigatório.',
            'testimonials.*.rating.nullable' => 'A avaliação é obrigatória.',
            'testimonials.*.rating.min' => 'A avaliação mínima é 1 estrela.',
            'testimonials.*.rating.max' => 'A avaliação máxima é 5 estrelas.',
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
