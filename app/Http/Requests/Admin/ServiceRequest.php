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
            'slug'             => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                "unique:services,slug,{$serviceId},id,deleted_at,NULL",
            ],
            'subtitle'         => 'nullable|string|max:255',
            'summary'          => 'nullable|string|max:500',
            'content'          => 'nullable|string',
            'banner'           => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status'           => 'required|in:published,draft',
            'show_in_menu'     => 'boolean',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords'    => 'nullable|string|max:255',
            'og_title'         => 'nullable|string|max:255',
            'og_description'   => 'nullable|string|max:500',
            'og_image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'  => 'O título é obrigatório.',
            'slug.required'   => 'O slug é obrigatório.',
            'slug.unique'     => 'Este slug já está em uso por outro serviço.',
            'slug.regex'      => 'O slug deve conter apenas letras minúsculas, números e hífens.',
            'status.required' => 'Selecione o status do serviço.',
            'status.in'       => 'Status inválido. Escolha entre Publicado ou Rascunho.',
            'banner.image'    => 'O banner deve ser uma imagem.',
            'banner.max'      => 'O banner não pode ultrapassar 5MB.',
            'image.image'     => 'A imagem de destaque deve ser uma imagem.',
            'image.max'       => 'A imagem de destaque não pode ultrapassar 5MB.',
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
