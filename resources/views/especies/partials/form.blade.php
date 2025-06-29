<form id="especieForm" onsubmit="crearEspecie(event)">
    
    <input type="hidden" id="especie_id" name="especie_id" value="">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" aria-describedby="nombreHelp">
                <div id="error-nombre" class="text-danger small"></div>
            </div>

            <div class="col-6 mb-3">
                <label for="nombre_cientifico" class="form-label">Nombre cientifico</label>
                <input type="text" class="form-control" id="nombre_cientifico" aria-describedby="nombreCientificoHelp">
                <div id="error-nombre_cientifico" class="text-danger small"></div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="image_path" class="form-label">Imagen de la especie</label>
        <input type="file" class="form-control" id="image_path" aria-describedby="imagePathHelp">

        <div class="d-flex justify-content-center mt-2">
            <img id="imagenPreview" src="" alt="Imagen previa" style="display:none; max-width: 200px;">
        </div>
        
        <div class="text-success">La carga de la imagen es opcional</div>
        <div id="error-image_path" class="text-danger small"></div>
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