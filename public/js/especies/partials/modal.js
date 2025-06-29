export function modalEspecie() {
    const modal = new bootstrap.Modal(document.getElementById('especieModal'));
    const form = document.getElementById('especieForm');

    // limpiar errores visuales
    document.querySelectorAll('.text-danger.small').forEach(err => err.textContent = '');

    // limpiar imagen
    const imagen = document.getElementById('imagenPreview');
    imagen.src = '';
    imagen.style.display = 'none';

    // limpiar input file
    document.getElementById('image_path').value = '';

    // limpiar campos
    form.reset();
    document.getElementById('especie_id').value = '';

    // título
    document.getElementById('especieModalLabel').textContent = 'Crear nueva especie';

    // asegurar que el botón no tiene eventos adicionales (por si viene de editar)
    const btnGuardar = document.getElementById('btnGuardar');
    btnGuardar.onclick = null; // si usás onclick
    btnGuardar.replaceWith(btnGuardar.cloneNode(true)); // opcional si agregaste listeners
    // PERO volvé a asignarle ID y type si hacés lo de arriba:
    const nuevoBtn = document.getElementById('btnGuardar'); // vuelve a obtenerlo
    nuevoBtn.setAttribute('id', 'btnGuardar');
    nuevoBtn.setAttribute('type', 'submit');

    modal.show();
}
