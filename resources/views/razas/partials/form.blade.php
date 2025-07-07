<form id="formRazas" onsubmit="crearRaza(event)">

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre">
        <span id="error-nombre" class="text-danger small"></span>
    </div>


    <div class="mb-3">
        <label for="select-especie" class="form-label">Especie</label> 
        <select id="select-especie" placeholder="Selecciona una especie..." autocomplete="off">
        </select>
        <span id="error-especie" class="text-danger small"></span>
    </div>

    <div class="mb-3">
        <label for="rasgos" class="form-label">Rasgos</label>
        <textarea class="form-control" id="rasgos"></textarea>
        <span id="error-rasgos" class="text-danger small"></span>
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




