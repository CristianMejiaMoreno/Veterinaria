@extends('layouts.app')

@section('title', 'Mascostas')

@section('content')

    <div class="container">

        <h1 class="mb-3">Gestión de Mascostas</h1>
    
        <p>Bienvenido al módulo de Mascostas. Aquí podrás registrar nuevos Mascostas, editar su información o eliminarlos si es necesario. 
        Esperamos que esta herramienta te ayude a mantener una gestión clara y organizada.</p>
        
        <div class="card">
            <div class="card-header">Listado de Mascostas</div>
            <div class="card-body">
                <button class="btn btn-success mb-3" id="btnCrearMascota" onclick="modal()">
                    Crear Mascota
                </button>

                @include('mascotas.partials.modal')
                {{ $dataTable->table() }}
            </div>
        </div>
        
    </div>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush