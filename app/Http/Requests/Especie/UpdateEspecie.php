<?php

namespace App\Http\Requests\Especie;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEspecie extends FormRequest
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
            'nombre_cientifico'=>'sometimes|string|max:100',
            'image_path'=>'nullable|image|max:5120'
        ];
    }
}
