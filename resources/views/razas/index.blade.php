@extends('layouts.app')

@section('title', 'Razas')

@section('content')

    <div class="container">

        <h1 class="mb-3">Gestión de Razas</h1>
    
        <p>Bienvenido al módulo de Razas. Aquí podrás registrar nuevos Razas, editar su información o eliminarlos si es necesario. 
        Esperamos que esta herramienta te ayude a mantener una gestión clara y organizada.</p>
        
        <div class="card">
            <div class="card-header">Listado de Razas</div>
            <div class="card-body">
                <button class="btn btn-success mb-3" id="btnCrearRaza" onclick="modal()">
                    Crear Raza
                </button>

                @include('razas.partials.modal')


                {{-- @include('especies.partials.imagen')
                @include('especies.partials.modal') --}}
                {{ $dataTable->table() }}
            </div>
        </div>
        
    </div>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush