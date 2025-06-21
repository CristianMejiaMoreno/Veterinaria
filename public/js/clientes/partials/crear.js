import { validarEmail, validarTelefono } from '../../validaciones/validaciones.js'; 

export function modalCliente()
{
    const myModal = new bootstrap.Modal(document.getElementById('clienteModal'));
    const formCrear = document.getElementById('formCliente');
    const errores = document.querySelectorAll('.text-danger.small');
    errores.forEach(el => {
        el.textContent = '';
    });   
    formCrear.reset();
        
    document.getElementById('clienteModalLabel').textContent = 'Crear cliente';

    const btnGuardar = document.getElementById('btnGuardar');
    btnGuardar.type = 'submit';
    btnGuardar.onclick = null;

    myModal.show();
}

export function crearCliente(event) {
    event.preventDefault();

    const nombre = document.getElementById('nombre').value.trim();
    const email = document.getElementById('email').value.trim();
    const direccion = document.getElementById('direccion').value.trim();
    const telefono = document.getElementById('telefono').value.trim();

    document.getElementById('error-nombre').textContent = '';
    document.getElementById('error-email').textContent = '';
    document.getElementById('error-telefono').textContent = '';
    document.getElementById('error-direccion').textContent = '';


    let valido = true;

    if (nombre === '') {
        document.getElementById('error-nombre').textContent = 'El nombre es obligatorio.';
        valido = false;
    } else if (nombre.length < 3) {
        document.getElementById('error-nombre').textContent = 'El nombre debe tener al menos 3 caracteres.';
        valido = false;
    }


    if (email === '') {
        document.getElementById('error-email').textContent = 'El email es obligatorio.';
        valido = false;
    } else if (!validarEmail(email)) {
        document.getElementById('error-email').textContent = 'El email no es válido.';
        valido = false;
    }

    if(!validarTelefono(telefono)){
        document.getElementById('error-telefono').textContent = 'El telefono no debe tener caracteres.';
        valido = false;
    }else if(telefono.length < 10){
        document.getElementById('error-telefono').textContent = 'El telefono debe tener 11 numeros.';
        valido = false;
    }

    if (direccion === '') {
        document.getElementById('error-direccion').textContent = 'La direccion es obligatoria.';
        valido = false;
    } 

    // Si todo está OK
    if (valido) {
        Swal.fire({
            title:"¿Estas seguro de la informacion del cliente?",
            icon:"warning",
            showCancelButton: true,
            confirmButtonColor: "#0c0c0c",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, deseo crearlo"
        }).then(async (result)=>{

            try{
                const url = window.APP_URL + '/admin/clientes';
                const token = document.querySelector('meta[name="csrf-token"]').content;

                const res = await fetch( url,{
                    method: 'POST',
                    headers:{
                        'Content-Type':'application/json',
                        'X-CSRF-TOKEN': token,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({nombre, email, telefono, direccion})
                });

                if(!res.ok){
                    throw new Error ('Error al crear el cliente');
                }

                await res.json();

                Swal.fire({
                    title: "¡Creado!",
                    text:"El cliente ha sido creado con exito",
                    icon:"success"
                });
                bootstrap.Modal.getOrCreateInstance('#clienteModal').hide();
                window.LaravelDataTables["clientes-table"].ajax.reload(null, false);
            }catch(err){
                Swal.fire('Error', err.message, 'error');
            }
        })
    }
}

