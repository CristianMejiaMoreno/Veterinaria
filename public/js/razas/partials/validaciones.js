export async function validaciones(nombre, especie, rasgos)
{
    const errNombre = document.getElementById('error-nombre');
    const errEspecie = document.getElementById('error-especie');
    const errRasgos = document.getElementById('error-rasgos');
    
    [errNombre, errEspecie, errRasgos].forEach(e =>{
        e.textContent = '';
    })

    let esValido = true;

    const nombreLimpio = (nombre || '').trim()

    if(nombreLimpio.length < 3) 
    {
        errNombre.textContent = 'El contenido del campo debe tener al menos tres caracteres';
        esValido = false;
    }else if(nombreLimpio.charAt(0) != nombreLimpio.charAt(0).toUpperCase()){
        errNombre.textContent = 'El nombre debe comenzar con una letra mayúscula';
        esValido = false;
    }

    if(!especie)
    {
        errEspecie.textContent = 'Debe de seleccionar al menos una especie';
        esValido = false;
    }

    if((rasgos || '').trim().length < 5)
    {
        errRasgos.textContent = 'Debe ingresar al menos un rasgos carecteristico de la raza';
        esValido = false;
    }

    return esValido;
}