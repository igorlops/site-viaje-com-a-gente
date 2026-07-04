<?php

namespace App\Http\Requests\Admin;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $serviceId = $this->route('service')?->id;

        return [
            'title'            => 'required|string|max:255',
            'subtitle'         => 'nullable|string|max:255',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'  => 'O título é obrigatório.',
            'image.image'     => 'A imagem deve ser uma imagem.',
            'image.max'       => 'A imagem não pode ultrapassar 5MB.',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Auto-gerar slug se não fornecido
        if (!$this->filled('slug') && $this->filled('title')) {
            $this->merge(['slug' => Str::slug($this->input('title'))]);
        } elseif ($this->filled('slug')) {
            $this->merge(['slug' => Str::slug($this->input('slug'))]);
        }
    }
}
