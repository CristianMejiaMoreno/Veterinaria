<?php

namespace App\Services;

use App\Models\Cliente;
use Illuminate\Database\QueryException;

class ClienteService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getClientes($request)
    {
        $search = $request->input('search');

        $query = Cliente::query();

        if (!empty($search)) {
            $query->where('nombre', 'like', '%' . $search . '%');
        }

        return $query->paginate(15)->appends($request->except('page'));
    }

    public function getClienteById($id)
    {
        $cliente = Cliente::findOrFail($id);

        return $cliente;
    }

    public function createCliente($data)
    {
        try
        {
            $cliente = Cliente::create($data);   

            return ['ok' => true,  'data' => $cliente];

        }catch(QueryException $e){
            switch ($e->errorInfo[1])
            {
                case 1062 :
                    return ['ok'=>false, 'code' => 422, 'msg'=> 'El email ya existe'];
                case 1406 :
                    return ['ok'=>false, 'code'=> 422, 'msg'=> 'Uno de los campos excede la longitud de los campos'];
                default:
                    return ['ok'=>false, 'code' => 500, 'msg' => 'Error de la base de datos'];
            }
        }
    }

    public function updateCliente($id, $request)
    {
        try
        {
            $cliente = Cliente::findOrFail($id);

            $cliente->update($request->all());

            return ['ok' => true,  'data' => $cliente];

        }catch(QueryException $e){
            switch ($e->errorInfo[1])
            {
                case 1062 :
                    return ['ok'=>false, 'code' => 422, 'msg'=> 'El email ya existe'];
                case 1406 :
                    return ['ok'=>false, 'code'=> 422, 'msg'=> 'Uno de los campos excede la longitud de los campos'];
                default:
                    return ['ok'=>false, 'code' => 500, 'msg' => 'Error de la base de datos'];
            }
        }
    }

    public function deleteCliente($id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->delete();

        return $cliente;
    }

    public function getClientesForTomSelect()
    {
        $clientes = Cliente::select('id as value', 'nombre as label')->get();

        return $clientes;
    }
}
