
import { tomSelect as tomSelectRaza } from '../../razas/partials/tomSelect.js';
import { tomSelect as tomSelectEspecie } from '../../especies/partials/tomSelect.js';
import { tomSelect as tomSelectCliente } from '../../clientes/partials/tomSelect.js';

export async function modal(preselectedIdRaza = null, preselectedIdEspecie = null, preselectedIdCliente = null ) 
{
    Swal.fire({
        title: "Recuperando informacion",
        text: "Espere un momento porfavor...",
        icon : "info",
        allowOutsideClick : false,
        didOpen: ()=>{
            Swal.showLoading();
        }
    });

    await Promise.all([
        tomSelectRaza(preselectedIdRaza),
        tomSelectEspecie(preselectedIdEspecie),
        tomSelectCliente(preselectedIdCliente)
    ]);

    Swal.close();

    const modal = new bootstrap.Modal(document.getElementById('mascotaModal'));

    const form = document.getElementById('mascotasForm');

    const titulo = document.getElementById('mascotaModalLabel');

    const btnGuardar = document.getElementById('btnGuardar');

    if (btnGuardar) {
        const newBtn = btnGuardar.cloneNode(true);
        btnGuardar.parentNode.replaceChild(newBtn, btnGuardar);
    }

    document.querySelectorAll('.text-danger.small').forEach(error=>{ error.textContent = ''});


    titulo.textContent = 'Crear Mascota'

    form.reset();

    modal.show();
}