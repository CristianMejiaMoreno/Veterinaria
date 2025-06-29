import { modalEspecie } from "./modal.js";


export async function crearEspecie(event) {

    event.preventDefault();

    
    document.getElementById('especie_id').value = ''
    
    const nombreEl            = document.getElementById('nombre');
    const nombreCientificoEl  = document.getElementById('nombre_cientifico');
    const imagenEl            = document.getElementById('image_path');
    const errNombre           = document.getElementById('error-nombre');
    const errNomCientifico    = document.getElementById('error-nombre_cientifico');
    const errImagen           = document.getElementById('error-image_path');

    [errNombre, errNomCientifico, errImagen].forEach(e => e.textContent = '');

    let valido = true;

    if (nombreEl.value.trim().length < 3) {
        errNombre.textContent = 'El nombre debe tener al menos 3 caracteres';
        valido = false;
    }

    if (nombreCientificoEl.value.trim().length < 3) {
        errNomCientifico.textContent = 'El nombre científico debe tener al menos 3 caracteres';
        valido = false;
    }

    const imagenFile = imagenEl.files[0];   // undefined si no se seleccionó nada
    if (imagenFile) {
        const tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];
        const maxSizeMB = 5;

        if (!tiposPermitidos.includes(imagenFile.type)) {
            errImagen.textContent = 'Sólo se permiten JPG, PNG o WEBP';
            valido = false;
        }
        if (imagenFile.size > maxSizeMB * 1024 * 1024) {
            errImagen.textContent = `La imagen no debe superar los ${maxSizeMB} MB`;
            valido = false;
        }
    }

    if (!valido) return;   // corta si algo no pasó

    const ok = await Swal.fire({
        title: '¿Crear especie?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0c0c0c',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, crear'
    });

    if (!ok.isConfirmed) return;

    try {
        const url   = `${window.APP_URL}/admin/especies`;
        const token = document.querySelector('meta[name="csrf-token"]').content;

        // FormData para enviar archivos
        const formData = new FormData();
        formData.append('nombre',   nombreEl.value.trim());
        formData.append('nombre_cientifico', nombreCientificoEl.value.trim());
        if (imagenFile) {
            formData.append('image_path', imagenFile);
        }

        const response = await fetch(url, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': token },
            body: formData
        });

        if (!response.ok) {
            if (response.status === 422) {
                const errores = await response.json();
                Object.values(errores.errors).flat().forEach(msg => Swal.fire('Validación', msg, 'error'));
            } else {
                throw new Error('Error inesperado');
            }
            return;
        }

        await response.json(); 

        Swal.fire('Creado', 'La especie se guardó con éxito', 'success');
        bootstrap.Modal.getInstance('#especieModal').hide();
        window.LaravelDataTables['especie-table'].ajax.reload(null, false);

    } catch (err) {
        Swal.fire('Ups', err.message, 'error');
    }
}
