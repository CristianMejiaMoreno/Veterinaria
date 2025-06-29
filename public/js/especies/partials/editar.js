import { modalEspecie } from "./modal.js";

export async function editarEspecie(id) {
    Swal.fire({
        title: "Verificando la información de la especie...",
        text: "Espere por favor.",
        icon: "info",
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });

    const url = window.APP_URL + '/admin/especies/' + id;
    const datos = await fetch(url);

    if (!datos.ok) {
        Swal.fire({ title: "Error al obtener la información", icon: "error" });
        return;
    }

    const especie = await datos.json();
    console.log('Especie cargada:', especie);

    Swal.close();
    modalEspecie();

    const campos = ['nombre', 'nombre_cientifico', 'image_path'];
    const titulo = document.getElementById('especieModalLabel');
    titulo.textContent = 'Editar especie';

    // Limpiar imagen previa
    const imagen = document.getElementById('imagenPreview');
    imagen.src = '';
    imagen.style.display = 'none';

    // Resetear formulario
    document.getElementById('especieForm').reset();

    // Asignar valores
    campos.forEach(campo => {
        const input = document.getElementById(campo);
        if (!input) return;

        if (campo === 'image_path') {
            if (especie[campo]) {
                imagen.src = `/storage/${especie[campo]}`;
                imagen.style.display = 'block';
            }
        } else {
            input.value = especie[campo] ?? '';
        }
    });

    // Listener para cambios (texto e imagen)
    const cambios = {};
    campos.forEach(campo => {
        const input = document.getElementById(campo);
        if (!input) return;

        input.addEventListener('input', e => {  
            if (campo === 'image_path' && input.files.length > 0) {
                const file = input.files[0];
                const reader = new FileReader();

                reader.onload = function (event) {
                    imagen.src = event.target.result;
                    imagen.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                cambios[campo] = e.target.value;
                console.log(`Campo cambiado: ${campo}, nuevo valor:`, cambios[campo]);
            }
        });
    });

    // Reemplazar botón para evitar múltiples eventos
    const oldBtnGuardar = document.getElementById('btnGuardar');
    const btnGuardar = oldBtnGuardar.cloneNode(true);
    oldBtnGuardar.parentNode.replaceChild(btnGuardar, oldBtnGuardar);
    btnGuardar.type = 'button';

    // Envío de datos
    btnGuardar.addEventListener('click', async (e) => {
        e.preventDefault();
        btnGuardar.disabled = true;

        try {
            const token = document.querySelector('meta[name="csrf-token"]').content;
            const formEditar = new FormData();

            formEditar.append('_method', 'PUT'); // importante para Laravel

            campos.forEach(campo => {
                const input = document.getElementById(campo);
                if (!input) return;

                if (campo === 'image_path') {
                    if (input.files.length > 0) {
                        formEditar.append(campo, input.files[0]);
                    }
                } else {
                    formEditar.append(campo, input.value.trim());
                }
            });

            const enviarDatos = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: formEditar
            });

            if (enviarDatos.ok) {
                Swal.fire('Actualizado', 'La especie se actualizó con éxito', 'success');
                bootstrap.Modal.getInstance('#especieModal').hide();
                window.LaravelDataTables['especie-table'].ajax.reload(null, false);
            } else {
                Swal.fire({ icon: 'error', title: 'Error al actualizar la especie' });
            }
        } catch (err) {
            Swal.fire('Ups', err.message, 'error');
        } finally {
            btnGuardar.disabled = false;
        }
    });
}
