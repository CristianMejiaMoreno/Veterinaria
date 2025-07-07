import { modal } from "./modal.js";
import { validaciones } from "./validaciones.js";
import { razaById } from "./razaById.js";

export async function editarRaza(id) {
    Swal.fire({
        title: "Cargando informacion de la raza...",
        text: "Por favor, espere un momento",
        icon: "info",
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });

    const raza = await razaById(id);
    Swal.close();
    await modal(raza.especie_id);

    const titulo = document.getElementById('razasModalLabel');
    titulo.textContent = 'Editar Raza';

    const inputs = [
        { id: 'nombre', key: 'nombre' },
        { id: 'rasgos', key: 'rasgos' },
    ];

    inputs.forEach(({ id, key }) => {
        const input = document.getElementById(id);
        if (input) input.value = raza[key] || '';
    });

    inputs.push({ id: 'select-especie', key: 'especie_id' });
    const cambios = {};
    inputs.forEach(({ id }) => {
        const input = document.getElementById(id);
        if (!input) return;
        input.addEventListener('input', event => {
            cambios[id] = event.target.value;
        });
    });

    const btnGuardar = document.getElementById("btnGuardar");
    btnGuardar.disabled = false; 

    if (btnGuardar) {
        btnGuardar.onclick = async function (e) {
            e.preventDefault();
            const nombre = document.getElementById('nombre').value;
            const especie = document.getElementById('select-especie').value;
            const rasgos = document.getElementById('rasgos').value;
            if (await validaciones(nombre, especie, rasgos)) {
                try {
                    btnGuardar.disabled = true;
                    const url = window.APP_URL + '/admin/razas/' + id;
                    const token = document.querySelector('meta[name="csrf-token"]').content;
                    const data = {nombre, especie_id:especie, rasgos};
                    const response = await fetch(url,{
                        method:"PUT",
                        headers:{
                            'X-CSRF-TOKEN':token,
                            'Content-Type':'application/json',
                            'Accept': 'application/json',
                        }, 
                        body: JSON.stringify(data)
                    })

                    if (!response.ok) {
                        const errorText = await response.text();
                        Swal.fire("Error", errorText, "error");
                        return;
                    }

                    Swal.fire("Éxito", "Raza actualizada correctamente", "success");
                    bootstrap.Modal.getOrCreateInstance("#razasModal").hide();
                    window.LaravelDataTables["raza-table"].ajax.reload(null, false);

                } catch (err) {
                    Swal.fire("Error", err?.message || err, "error");
                    btnGuardar.disabled = false; 
                }
            }else{
                return;
            }
        };
    }
}