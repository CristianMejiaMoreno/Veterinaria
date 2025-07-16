import { calculoEdad } from "./calculoEdad.js";
import { validaciones } from "./validaciones.js";

export async function crearMascota(event) {
    event.preventDefault();

    const fecha_nacimiento_input = document.getElementById('fecha_nacimiento');
    const edad_input = document.getElementById('edad');

    fecha_nacimiento_input.addEventListener('input', () => {
        const edadCalculada = calculoEdad();
        edad_input.value = edadCalculada;
    });

    const dataForm = {
        nombre: document.getElementById('nombre').value,
        especie: document.getElementById('select-especie').value,
        raza: document.getElementById('select-raza').value,
        cliente: document.getElementById('select-cliente').value,
        fecha_nacimiento: fecha_nacimiento_input.value,
        edad: edad_input.value,
        sexo: document.querySelector('input[name="sexo"]:checked').value
    };

    if (!(await validaciones(dataForm))) {
        return;
    }

    const button = document.getElementById('btnGuardar');
    button.disabled = true;

    const token = document.querySelector('meta[name="csrf-token"]').content;
    const url = window.APP_URL + '/admin/mascotas';

    const form = {
        nombre: dataForm.nombre,
        especie_id: dataForm.especie,
        cliente_id: dataForm.cliente,
        raza_id: dataForm.raza,
        sexo: dataForm.sexo,
        fecha_nacimiento: dataForm.fecha_nacimiento,
        edad: dataForm.edad
    };

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(form)
        });

        if (!response.ok) {
            const errorText = await response.text();
            Swal.fire('Error al crear la mascota', errorText, "error");
            return;
        }

        Swal.fire({
            title: "¡Éxito!",
            text: "Se ha creado una nueva mascota",
            icon: "success"
        });

        const modal = document.getElementById("mascotaModal");
        bootstrap.Modal.getOrCreateInstance(modal).hide();
        window.LaravelDataTables["mascotas-table"].ajax.reload(null, false);
    } catch (error) {
        console.error(error);
        Swal.fire('Error inesperado', 'No se pudo crear la mascota', 'error');
    }
}
