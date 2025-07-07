<?php

namespace App\Services;

use App\Models\Especie;
use Exception;

class EspecieService
{

    protected ImagenService $imagenService;

    /**
     * Create a new class instance.
     */
    public function __construct(ImagenService $imagenService)
    {
        $this->imagenService = $imagenService;
    }

    public function getEspecies($request)
    {
        $search = $request->input('search');
        $query = Especie::query();

        if($search)
        {
            $query->where('nombre', 'like', '%'.$search.'%');
        }

        return $query->paginate(15)->appends($request->except('page'));
    }
    
    public function getEspeciesById($id)
    {
        $Especie = Especie::findOrFail($id);

        return $Especie;
    }

    public function createEspecie($request)
    {
        try
        {
            $data = $request->only(['nombre', 'nombre_cientifico']);

            if ($request->hasFile('image_path')) {
                $data['image_path'] = $this->imagenService->guardarImagen('especies', $request->file('image_path'));
            }

            return Especie::create($data);

        }catch(Exception $e){
            throw new Exception('Error al crear una nueva Especie');
        }
    }

    public function updateEspecie($id, $request)
    {
        try
        {
            $especie = Especie::findOrFail($id);
            $data = $request->only(['nombre', 'nombre_cientifico']);

            if ($request->hasFile('image_path')) {
                $data['image_path'] = $this->imagenService->guardarImagen('especies', $request->file('image_path'));
            }

            $especie->update($data);

            return $especie;
        }catch(Exception $e)
        {
            throw new Exception('Error al actualizar la Especie');
        }
    }

    public function deleteEspecie($id)
    {
        $Especie = Especie::findOrFail($id);
        $Especie->delete();

        return $Especie;
    }

    public function getEspeciesForTomSelect()
    {
        $especies = Especie::select('id as value', 'nombre as label')->get();

        return $especies;
    }
}
