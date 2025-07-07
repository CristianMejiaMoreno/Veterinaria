export async function razaById(id)
{
    const url = window.APP_URL + '/admin/razas/' +id
    const response = await fetch(url);
    const raza = await response.json();

    return raza;
}