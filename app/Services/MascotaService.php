<?php

namespace App\Services;

use App\Models\Mascotas;
use Exception;

class MascotaService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getMascotas($request)
    {
        $search = $request->input('search');

        $query = Mascotas::query();

        if($search)
        {
            $query->where('nombre', 'like', '%' . $search . '%');

        }

        return $query->paginate(15)->appends($request->except('page'));
    }

    public function getMascotaById($id)
    {
        $mascota = Mascotas::with('cliente')->findOrFail($id);

        return $mascota;
    }

    public function createMascota($request)
    {
        try{

            $mascota = Mascotas::create($request);

            return $mascota;

        }catch(Exception $e){
            throw new Exception('Error no se pudo crear la mascota');
        }
    }

    public function updateMascota($id, $request)
    {
        try
        {
            $mascota = Mascotas::findOrFail($id);

            $mascota->update($request);

            return $mascota;


        }catch(Exception $e)
        {
            throw new Exception('Error, no se pudo actualizar la mascota');
        }
    }

    public function deleteMascota($id)
    {
        $mascota = Mascotas::findOrFail($id);

        $mascota->delete();

        return $mascota;
    }

}
