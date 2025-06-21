import { modalCliente, crearCliente } from '../clientes/partials/crear.js'; 
import {editarCliente } from '../clientes/partials/editar.js'; 
import {borrarCliente } from '../clientes/partials/borrar.js';

window.modalCliente = modalCliente;

window.crearCliente = crearCliente;

window.editarCliente = editarCliente;

window.borrarCliente = borrarCliente;



async function getGatos()
{
    const url = "https://api.thecatapi.com/v1/breeds";
    const res = await fetch(url);

    const json = await res.json()

    console.log(json)
}

getGatos();


//    async function getClientes(){
//         const url = window.APP_URL + '/admin/clientes';
//         const response = await fetch (url);

//         if(!response.ok)
//         {
//             throw new Error(`Error ${response.status}`)
//         }

//         const json = await response.json();
//         console.log(json);
//     }

//     getClientes();
