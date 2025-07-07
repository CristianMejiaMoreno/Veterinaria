<?php

namespace App\Http\Requests\Raza;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRaza extends FormRequest
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
            'nombre'=>'sometimes|string|max:100',
            'especie_id'=>'sometimes|exists:especies,id',
            'rasgos'=>'sometimes|string'
        ];
    }
}
