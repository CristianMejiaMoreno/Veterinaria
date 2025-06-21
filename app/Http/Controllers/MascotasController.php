<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        try{

        }catch(Exception)
        {
            
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mascotas $mascotas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mascotas $mascotas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mascotas $mascotas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mascotas $mascotas)
    {
        //
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
