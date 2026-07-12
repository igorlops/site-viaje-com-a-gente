<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'author_name'  => 'required|string|max:255',
            'author_role'  => 'nullable|string|max:255',
            'author_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'content'      => 'required|string',
            'rating'       => 'required|integer|min:1|max:5',
            'destination_id' => 'nullable|exists:destinations,id',
            'is_active'    => 'boolean',
            'order'        => 'nullable|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'author_name.required' => 'O nome do autor é obrigatório.',
            'content.required'     => 'O texto do depoimento é obrigatório.',
            'rating.required'      => 'A avaliação é obrigatória.',
            'rating.min'           => 'A avaliação mínima é 1 estrela.',
            'rating.max'           => 'A avaliação máxima é 5 estrelas.',
            'destination_id.exists' => 'O destino selecionado é inválido.',
        ];
    }
}
