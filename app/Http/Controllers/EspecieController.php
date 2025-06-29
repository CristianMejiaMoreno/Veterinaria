<?php

namespace App\Http\Controllers;

use App\Http\Requests\Especie\UpdateEspecie;
use App\Services\EspecieService;
use App\DataTables\EspecieDataTable;
use App\Http\Requests\Especie\CreateEspecie;
use App\Models\Especie;
use Illuminate\Http\Request;
use Exception;

class EspecieController extends Controller
{

    protected $especieService;

    public function __construct(EspecieService $especieService) {
        $this->especieService = $especieService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(EspecieDataTable $especieDataTable)
    {
        return $especieDataTable->render('especies.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEspecie $request)
    {
        try
        {
            $especie = $this->especieService->createEspecie($request);

            return response($especie, 200);
        }catch(Exception $e){
            return response()->json([
               'Error al crear una nueve especie' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try
        {
            $especie = $this->especieService->getEspeciesById($id);

            return response($especie, 200);
        }catch(Exception $e){
            return response()->json([
                'Error al buscar la especie'=>$e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, UpdateEspecie $request)
    {
        try{
            $especie = $this->especieService->updateEspecie($id, $request);

            return response($especie, 200);
        }catch(Exception $e){
            return response()->json([
                "Error"=>$e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $especie = $this->especieService->deleteEspecie($id);

            return response($especie, 200);
        }catch(Exception $e){
            return response()->json([
                "Error"=>$e->getMessage()
            ], 500);
        }
    }
}
