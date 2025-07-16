<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cliente\CreateCliente;
use App\Http\Requests\Cliente\UpdateCliente;
use App\Models\Cliente;
use App\Services\ClienteService;
use Exception;
use Illuminate\Http\Request;
use App\DataTables\ClientesDataTable;

class ClienteController extends Controller
{

    protected $clienteService;

    public function __construct(ClienteService $clienteService) {
        $this->clienteService = $clienteService;
    }

    /**
     * Display a listing of the resource.
     */

     public function index(ClientesDataTable $clientesDataTable)
     {
        return $clientesDataTable->render('clientes.index');
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCliente $request)
    {
        try{
            $cliente = $this->clienteService->createCliente($request->validated());

            return response($cliente, 200);

        }catch(Exception $e)
        {
            return response()->json([
                "Error al crear cliente"=> $e->getMessage()
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
            $cliente = $this->clienteService->getClienteById($id);
            
            return response()->json($cliente, 200);

        }catch(Exception $e)
        {
            return response()->json([
                'Error desconocido' => $e->getMessage()
            ],500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCliente $request, int $id)
    {
        try
        {
            $cliente = $this->clienteService->updateCliente($id, $request);

            return response()->json($cliente, 200);

        }catch(Exception $e){
            return response()->json([
                'Error desconocido'=>$e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try
        {
            $cliente = $this->clienteService->deleteCliente($id);

            return response($cliente, 200);

        }catch(Exception $e)
        {
            return response()->json([
                'Error desconocido'=>$e->getMessage()
            ]);
        }
    }

    public function clientesForTomSelect()
    {
        try
        {
            $clientes = $this->clienteService->getClientesForTomSelect();

            return response($clientes, 200);
        }catch(Exception $e)
        {
            return response()->json([
                "Error"=>$e->getMessage()
            ], 500);
        }
    }
}
