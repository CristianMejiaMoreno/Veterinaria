export function validarEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

export function validarTelefono(telefono) {
    const soloNumeros = /^\d+$/;
    return soloNumeros.test(telefono);
}