<form id="formCliente" onsubmit="crearCliente(event)">
    @csrf

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" aria-describedby="nombreHelp">
                 <div id="error-nombre" class="text-danger small"></div>
            </div>

            <div class="col-6 mb-3">
                <label for="direccion" class="form-label">Direccion</label>
                <input type="text" class="form-control" id="direccion" aria-describedby="direccionHelp">
                <div id="error-direccion" class="text-danger small"></div>
            </div>
        </div>

        <div class="row justify-content-center">
            
            <div class="col-6 mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="text" class="form-control" id="telefono" aria-describedby="telefonoHelp">
                <div id="error-telefono" class="text-danger small"></div>
            </div>

            <div class="col-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                <div id="error-email" class="text-danger small"></div>
            </div>
        
        </div>
    </div>

    <div class="row mt-4 justify-content-center">
        <div class="col-auto text-center">
            <button type="submit" class="btn btn-dark" id="btnGuardar">Enviar</button>
        </div>
        <div class="col-auto text-center">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
        </div>
    </div>


</form>