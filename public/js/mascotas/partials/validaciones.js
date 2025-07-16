export async function validaciones({ nombre, especie, raza, cliente, fecha_nacimiento, sexo }) 
{
    
    const errEspecie = document.getElementById('error-especie');
    const errRaza = document.getElementById('error-raza');
    const errCliente = document.getElementById('error-cliente');
    const errNombre = document.getElementById('error-nombre');
    const errFechaNacimiento = document.getElementById('error-fecha_nacimiento');
    const errSexo = document.getElementById('error-sexo');

    [errEspecie, errRaza, errCliente, errNombre, errFechaNacimiento, errSexo].forEach(input=>{
        input.textContent = '';
    });

    let esValido = true;

    if(nombre.length < 3)
    {
        errNombre.textContent = 'El nombre debe tener al menos tres caracteres';
        esValido = false;
    }else if(nombre.charAt(0) != nombre.charAt(0).toUpperCase())
    {
        errNombre.textContent = 'El nombre debe comenzar con una mayuscula';
        esValido = false;
    }

    if(!especie)
    {
        errEspecie.textContent = 'Debe de seleccionar una especie';
        esValido = false;
    }

    if(!raza)
    {
        errRaza.textContent = 'Debe de seleccionar una raza';
        esValido = false;
    }

    if(!cliente)
    {
        errCliente.textContent = 'Debe de seleccionar un cliente';
        esValido = false;
    }

    if (fecha_nacimiento) {
        var diaActual = Date.now(); 
        var fechaNacimiento = new Date(fecha_nacimiento).getTime();

        if (fechaNacimiento > diaActual) {
            errFechaNacimiento.textContent = 'La fecha no debe ser mayor a la actual';
            esValido = false;
        }
    }

    if(!sexo)
    {
        errSexo.textContent = 'Debe de elegir un genero';
        esValido = false;
    }

    return esValido;
}