<?php

namespace App\Services;

use App\Models\Raza;

class RazaService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getRazas($request)
    {
        $search = $request->input('search');
        $query = Raza::query();

        if($search)
        {
            $query->where('nombre','like','%'.$search.'%');
        }

        return $query->paginate(15)->appends($request->except('page'));
    }

    public function getRazaById($id)
    {
        $raza = Raza::findOrFail($id);

        return $raza;
    }

    public function createRaza($request)
    {
        $raza = Raza::create($request);

        return $raza;
    }

    public function updateRaza($id, $request)
    {
        $raza = Raza::findOrFail($id);

        $raza->update($request);

        return $raza;
    }

    public function deleteRaza($id)
    {
        $raza = Raza::findOrFail($id);

        $raza->delete();

        return $raza;
    }
    
}
