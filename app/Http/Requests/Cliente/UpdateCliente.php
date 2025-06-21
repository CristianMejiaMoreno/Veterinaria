<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCliente extends FormRequest
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
            'nombre' => 'sometimes|max:100|string',
            'telefono'=> 'sometimes|max:10|string',
            'direccion'=> 'sometimes|string',
            'email' => 'sometimes|email|unique:clientes,email',
        ];
    }
}
