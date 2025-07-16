@extends('layouts.app')

@section('title', 'Especies')

@section('content')
    
    <div class="container">

        <h1 class="mb-3">Gestión de Especies</h1>
    
        <p>Bienvenido al módulo de especies. Aquí podrás registrar nuevos especies, editar su información o eliminarlos si es necesario. 
        Esperamos que esta herramienta te ayude a mantener una gestión clara y organizada.</p>
        
        <div class="card">
            <div class="card-header">Listado de especies</div>
            <div class="card-body">
                <button class="btn btn-success mb-3" id="btnCrearEspecie" onclick="modalEspecie()" >
                    Crear especie
                </button>
                @include('especies.partials.imagen')
                @include('especies.partials.modal')
                {{ $dataTable->table() }}
            </div>
        </div>
        
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
