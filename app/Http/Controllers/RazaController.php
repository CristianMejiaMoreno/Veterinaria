<?php

namespace App\Http\Controllers;

use App\DataTables\RazaDataTable;
use App\Http\Requests\Raza\CreateRaza;
use App\Http\Requests\Raza\UpdateRaza;
use App\Models\Raza;
use App\Services\RazaService;
use Illuminate\Http\Request;
use Exception;

class RazaController extends Controller
{
    protected $razaService;

    public function __construct(RazaService $razaService)
    {
        $this->razaService = $razaService; 
    }

    /**
     * Display a listing of the resource.
     */
    public function index(RazaDataTable $razaDataTable)
    {
        return $razaDataTable->render('razas.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRaza $request)
    {
        try{
            
            $raza = $this->razaService->createRaza($request->validated());

            return response ($raza, 200);

        }catch(Exception $e){
            return response()->json([
                "Error"=>$e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $raza = $this->razaService->getRazaById($id);

            return response($raza, 200);
        }catch(Exception $e){
            return response()->json([
                "Error"=>$e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRaza $request, int $id)
    {
        try{
            $raza = $this->razaService->updateRaza($id, $request->validated());

            return response($raza, 200);
        }catch(Exception $e)
        {
            return response()->json([
                "Error"=>$e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try{
            $raza = $this->razaService->deleteRaza($id);

            return response($raza, 200);
        }catch(Exception $e){
            return response()->json([
                "Error"=>$e->getMessage()
            ], 500);
        }
    }

    public function razasForTomSelect()
    {
        try
        {
            $razas = $this->razaService->getRazasForTomSelect();

            return response($razas, 200);
        }catch(Exception $e)
        {
            return response()->json([
                "Error"=>$e->getMessage()
            ], 500);
        }
    }
    
}
