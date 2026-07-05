<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:2000',
            'order' => 'nullable|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'question.required' => 'A pergunta é obrigatória.',
            'answer.required' => 'A resposta é obrigatória.',
        ];
    }
}
