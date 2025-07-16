export async function calculoEdad() {
    const fechaNacimiento = document.getElementById('fecha_nacimiento').value;
    const fechaActual = new Date();
    const nacimiento = new Date(fechaNacimiento);

    const edadMascota = fechaActual.getFullYear() - nacimiento.getFullYear();

    const edad = document.getElementById('edad');
    edad.value = edadMascota;

    return edadMascota; 
}
