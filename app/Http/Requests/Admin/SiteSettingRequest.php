<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $type = $this->route('setting')?->type ?? 'text';

        return match ($type) {
            'image' => [
                'value' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ],
            'email' => [
                'value' => 'nullable|email|max:255',
            ],
            'url' => [
                'value' => 'nullable|url|max:500',
            ],
            default => [
                'value' => 'nullable|string|max:1000',
            ],
        };
    }

    public function messages(): array
    {
        return [
            'value.image'    => 'O arquivo deve ser uma imagem válida.',
            'value.mimes'    => 'Formatos aceitos: JPEG, PNG, JPG, GIF, SVG, WebP.',
            'value.max'      => 'O arquivo não pode ultrapassar 2 MB.',
            'value.email'    => 'Informe um e-mail válido.',
            'value.url'      => 'Informe uma URL válida.',
            'value.string'   => 'O valor deve ser um texto.',
        ];
    }
}
