<?php

namespace App\Http\Requests\Mascota;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMascota extends FormRequest
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
            'especie_id'=>'sometimes|exists:especies,id',
            'cliente_id'=>'sometimes|exists:clientes,id',
            'raza_id'=>'sometimes|exists:razas,id',
            'nombre'=>'sometimes|string',
            'fecha_nacimiento'=>'sometimes|date',
            'sexo'=>'sometimes|boolean',
            'edad'=>'sometimes|integer'
        ];
    }
}
