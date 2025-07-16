<?php

namespace App\Http\Controllers;

use App\DataTables\MascotasDataTable;
use App\Http\Requests\Mascota\CreateMascota;
use App\Http\Requests\Mascota\UpdateMascota;
use App\Models\Mascotas;
use App\Services\DogApiService;
use App\Services\MascotaService;
use Exception;
use Illuminate\Http\Request;
use App\Services\CatApiService;

class MascotasController extends Controller
{
    protected $apiGatos;
    protected $apiPerros;

    protected $mascotaService;

    public function __construct(CatApiService $catApiService, DogApiService $dogApiService, MascotaService $mascotaService)
    {
        $this->apiGatos = $catApiService;
        $this->apiPerros = $dogApiService;
        $this->mascotaService = $mascotaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(MascotasDataTable $mascotasDataTable)
    {
       try
       {
        return $mascotasDataTable->render('mascotas.index');
       }catch(Exception $e){
        return response()->json([
            "Error"=>$e->getMessage()
        ], 500);
       }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMascota $request)
    {
        try
        {
            $mascota = $this->mascotaService->createMascota($request->validated());

            return response($mascota, 200);
        }catch(Exception $e)
        {
            return response()->json([
                "Error"=>$e->getMessage()
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try
        {
            $mascota = $this->mascotaService->getMascotaById($id);

            return $mascota;
        }catch(Exception $e)
        {
            return response()->json([
                "Error"=>$e->getMessage()
            ], 500);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMascota $request, int $id)
    {
        try
        {

            $mascota = $this->mascotaService->updateMascota($id, $request->validated());

            return response($mascota, 200);
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
        try
        {
            $mascota = $this->mascotaService->deleteMascota($id);

            return response($mascota, 200);
        }catch(Exception $e)
        {
            return response()->json([
                "Error"=>$e->getMessage()
            ], 500);
        }
    }

    public function getGatos()
    {
        try{
            $gatos = $this->apiGatos->getCatsByBreed();
            return response($gatos, 200);
        }catch(Exception $e){
            return response()->json([
                "Error"=>$e->getMessage()
            ], 500);
        }
    }

    public function getPerros()
    {
        try{
            $perros = $this->apiPerros->getDogsByBreed();
            return response($perros, 200);
        }catch(Exception $e){
            return response()->json([
                "Error"=>$e->getMessage()
            ], 500);
        }
    }
}
