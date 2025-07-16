export async function mascotaById(id) {
    const url = window.APP_URL + '/admin/mascotas/' +id;
    const response = await fetch(url);

    const mascota = response.json();

    return mascota;
}