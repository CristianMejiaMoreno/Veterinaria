import {modal} from  './modal.js';
import { mascotaById } from './mascotaById.js';

export async function editarMascota(id) 
{
    const mascota = await mascotaById(id);

    await modal(mascota.raza_id, mascota.especie_id, mascota.cliente_id);

    Swal.close();

    const titulo = document.getElementById('mascotaModalLabel');
    titulo.textContent = 'Editar Mascota';

    const inputs = [
        {id: 'nombre', key: 'nombre'},
        {id: 'fecha_nacimiento', key: 'fecha_nacimiento'},
        {id: 'edad', key: 'edad'},
        {id: 'sexo', key: 'sexo'},
    ]

    inputs.forEach(({id, key})=>{
        if(id === 'sexo')
        {
            const sexoValue = mascota[key];
            const selector = `input[name="sexo"][value="${sexoValue}"]`;
            const sexoInput = document.querySelector(selector);
            if(sexoInput)
            {
                sexoInput.checked = true;
            }
        }else{
            const input = document.getElementById(id);
            if (input) input.value = mascota[key] || '';
        }
    });

    inputs.push(
        {id:"select-raza", key:"raza_id"},
        {id:"select-especie", key:"especie_id"},
        {id:"select-cliente", key:"cliente_id"},
    )

    const cambios = {};

    inputs.forEach(({ id, key }) => {
        if (id === "sexo") {
            const radios = document.querySelectorAll('input[name="sexo"]');
            radios.forEach(radio => {
                radio.addEventListener("input", (event) => {
                    if (event.target.checked) {
                        cambios[key] = event.target.value;
                    }
                });
            });
        } else {
            const input = document.getElementById(id);
            if (!input) return;

            input.addEventListener("input", (event) => {
                cambios[key] = event.target.value;
                console.log(cambios)
            });
        }
    });

    const btnGuardar = document.getElementById("btnGuardar");
    btnGuardar.disabled = false; 

    btnGuardar.addEventListener('click', async (e)=>{
        e.preventDefault();

        btnGuardar.disabled = true;

        const token = document.querySelector('meta[name="csrf-token"]').content;
        const url = window.APP_URL + '/admin/mascotas/' +id;

        const response = await fetch(url, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(cambios)
        });

        if (!response.ok) {
            const errorText = await response.text();
            Swal.fire("Error", errorText, "error");
            return;
        }

        Swal.fire({
            title: "¡Éxito!",
            text: "Se ha actualiza la informacion de la mascota",
            icon: "success"
        });

        const modal = document.getElementById("mascotaModal");
        bootstrap.Modal.getOrCreateInstance(modal).hide();
        window.LaravelDataTables["mascotas-table"].ajax.reload(null, false);

    })

}