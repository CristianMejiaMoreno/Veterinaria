<form id="mascotasForm" onsubmit="crearMascota(event)">

    <div class="mb-3">
        <label for="select-especie" class="form-label">Especie</label> 
        <select id="select-especie" placeholder="Selecciona una especie..." autocomplete="off">
        </select>
        <span id="error-especie" class="text-danger small"></span>
    </div>

    <div class="mb-3">
        <label for="select-raza" class="form-label">Raza</label> 
        <select id="select-raza" placeholder="Selecciona una raza..." autocomplete="off">
        </select>
        <span id="error-raza" class="text-danger small"></span>
    </div>

    <div class="mb-3">
        <label for="select-cliente" class="form-label">Cliente</label> 
        <select id="select-cliente" placeholder="Selecciona un cliente..." autocomplete="off">
        </select>
        <span id="error-cliente" class="text-danger small"></span>
    </div>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre">
        <span id="error-nombre" class="text-danger small"></span>
    </div>

    <div class="row">
        <div class="col-4">
            <label for="fecha_nacimiento" class="form-label">Fecha nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" onchange="calculoEdad()">
            <span id="error-fecha_nacimiento" class="text-danger small"></span>
        </div>

        <div class="col-4">
            <label for="edad" class="form-label">Edad</label>
            <input type="text" class="form-control" id="edad">
        </div>

        <div class="col-4">
            <div class="mb-3">
                <input class="form-check-input" type="radio" name="sexo" id="masculino" value="1" checked>
                <label class="form-check-label" for="masculino">
                    Masculino
                </label>
            </div>

            <div class="mb-3">
                <input class="form-check-input" type="radio" name="sexo" id="femenino" value="0">
                <label class="form-check-label" for="femenino">
                    Femenino
                </label>
            </div>

            <span id="error-sexo" class="text-danger small"></span>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-auto text-center">
                <button type="submit" class="btn btn-dark" id="btnGuardar">Enviar</button>
            </div>

            <div class="col-auto text-center">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>

</form>