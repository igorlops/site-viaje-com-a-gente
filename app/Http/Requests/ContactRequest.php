<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|min:8|max:50',
            'message' => 'required|string|min:10|max:2000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.min' => 'O nome deve ter pelo menos 2 caracteres.',
            'name.max' => 'O nome não pode passar de 255 caracteres.',
            'email.required' => 'O campo E-mail é obrigatório.',
            'email.email' => 'Por favor, informe um endereço de e-mail válido.',
            'email.max' => 'O e-mail não pode passar de 255 caracteres.',
            'phone.min' => 'O telefone deve ter pelo menos 8 dígitos.',
            'phone.max' => 'O telefone não pode passar de 50 caracteres.',
            'message.required' => 'O campo Mensagem é obrigatório.',
            'message.min' => 'A mensagem deve ter pelo menos 10 caracteres.',
            'message.max' => 'A mensagem não pode passar de 2000 caracteres.',
        ];
    }
}
