<?php

namespace App\Http\Requests\Mascota;

use Illuminate\Foundation\Http\FormRequest;

class CreateMascota extends FormRequest
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
            'especie_id'=>'required|exists:especies,id',
            'cliente_id'=>'required|exists:clientes,id',
            'raza_id'=>'required|exists:razas,id',
            'nombre'=>'required|string',
            'fecha_nacimiento'=>'required|date',
            'sexo'=>'required|boolean',
            'edad'=>'required|integer'
        ];
    }
}
