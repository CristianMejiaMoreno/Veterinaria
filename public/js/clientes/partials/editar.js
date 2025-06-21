import { modalCliente } from "./crear.js";
import { validarEmail, validarTelefono } from '../../validaciones/validaciones.js'; 

export async function editarCliente(id){

    Swal.fire({
      title: "Obteniendo la información del cliente...",
      text: "Espere por favor.",
      icon: "info",
      showConfirmButton: false,    
      showCancelButton: false,     
      willOpen: () => {
        Swal.showLoading();
      }
    });

    const url = window.APP_URL + '/admin/clientes/' + id;
    const response = await fetch(url);

    if(!response.ok)
    {
      throw new Error(`Error ${response.status}`);
    }

    const cliente = await response.json();

    Swal.close();
    modalCliente();

    const campos = ['nombre', 'email', 'direccion', 'telefono'];

    const titulo = document.getElementById('clienteModalLabel');

    titulo.textContent = "Editar cliente " + cliente.nombre

    const cambios = {};

    //pone el valor en el input
    campos.forEach(campo => {
        const input = document.getElementById(campo);
        if (input) input.value = cliente[campo] ?? '';
    });

    campos.forEach(campo => {
        const input = document.getElementById(campo);

        input.addEventListener('input', e =>{
            cambios[campo] = e.target.value;
        });
    });

    const btnGuardar = document.getElementById('btnGuardar');

    btnGuardar.type = 'button';

    btnGuardar.onclick = async e => {
      e.preventDefault();           

      const btn = e.currentTarget;
      btn.disabled = true;

      try {
        const token = document.querySelector('meta[name="csrf-token"]').content;

        const enviarDatos = await fetch(url, {
          method : 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest',
          },
          body : JSON.stringify(cambios)
        });

        if (enviarDatos.ok) {
          window.LaravelDataTables["clientes-table"].ajax.reload(null, false);
          bootstrap.Modal.getOrCreateInstance('#clienteModal').hide();
          Swal.fire({ icon: 'success', title: 'Cliente actualizado correctamente' });
        } else {
          Swal.fire({ icon: 'error', title: 'Error al actualizar el cliente' });
        }

      } catch (err) {
        Swal.fire({ icon: 'error', title: 'Error de red', text: err.message });
      }
    };

}