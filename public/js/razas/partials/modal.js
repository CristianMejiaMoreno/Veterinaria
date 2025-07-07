import { tomSelect } from "./tomSelect.js";

export async function modal(preselectedId = null)
{
    await tomSelect(preselectedId);

    const modal = new bootstrap.Modal(document.getElementById('razasModal'));

    const form = document.getElementById('formRazas');

    const titulo = document.getElementById('razasModalLabel');
 
    document.querySelectorAll('.text-danger.small').forEach(err => err.textContent = '');

    const btnGuardar = document.getElementById('btnGuardar');

    if (btnGuardar) {
        const newBtn = btnGuardar.cloneNode(true);
        btnGuardar.parentNode.replaceChild(newBtn, btnGuardar);
    }

    titulo.textContent = 'Crear Raza';

    form.reset();

    modal.show();
}