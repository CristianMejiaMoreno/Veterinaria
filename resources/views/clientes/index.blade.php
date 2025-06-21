@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
    
    <div class="container">

        <h1 class="mb-3">Gestión de Clientes</h1>
    
        <p>Bienvenido al módulo de clientes. Aquí podrás registrar nuevos clientes, editar su información o eliminarlos si es necesario. 
        Esperamos que esta herramienta te ayude a mantener una gestión clara y organizada.</p>
        
        <div class="card">
            <div class="card-header">Listado de clientes</div>
            <div class="card-body">
                <button class="btn btn-success mb-3" id="btnCrearCliente" onclick="modalCliente()">
                    Crear cliente
                </button>
                @include('clientes.partials.modal')
                {{ $dataTable->table() }}
            </div>
        </div>
        
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
