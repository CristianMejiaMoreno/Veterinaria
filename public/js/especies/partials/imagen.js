export function mostrarImagen(url)
{
    const img = document.querySelector('#modalImg img');
    img.src = url;
    bootstrap.Modal.getOrCreateInstance('#modalImg').show();
}