<?php

namespace App\Http\Requests\Itens;

use Illuminate\Foundation\Http\FormRequest;

class CreateItensRequest extends FormRequest
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
            'nome' => 'required',
            'lista_id' => ['required', 'exists:listas,id'],
            'status' => ['nullable'],
            'previsao' => ['nullable'],
            'conclusao' => ['nullable'],
        ];
    }
}
