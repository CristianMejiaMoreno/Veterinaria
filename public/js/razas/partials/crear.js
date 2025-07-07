import { validaciones } from "./validaciones.js";

export async function crearRaza(event)
{
    event.preventDefault();
    

    const nombre = document.getElementById('nombre')?.value || '';
    const especie = document.getElementById('select-especie')?.value || '';
    const rasgos = document.getElementById('rasgos')?.value || '';

    if(await validaciones(nombre, especie, rasgos))
    {
        try{
            const formData = {nombre: nombre, especie_id: especie, rasgos: rasgos};
            const token = document.querySelector('meta[name="csrf-token"]').content;    
            const url = window.APP_URL + "/admin/razas";    

            const response = await fetch(url,{
                method:"POST",
                headers:{
                    'Content-Type':'application/json',
                    'Accept': 'application/json',
                    "X-CSRF-TOKEN": token,
                }, 
                body: JSON.stringify(formData)
            });

            if (!response.ok) {
                const errorText = await response.text();
                Swal.fire("Error al intentar una nueva raza", errorText, "error");
                return;
            }

            Swal.fire({
                title:"Exito!",
                text:"Se ha creado una nueva raza",
                icon:"success"
            });

            bootstrap.Modal.getOrCreateInstance("#razasModal").hide();
            window.LaravelDataTables["raza-table"].ajax.reload(null, false);

        }catch(err)
        {
            Swal.fire({
                title:"Ups!",
                text: "Se ha presentado un error: " + err,
                icon: "error"
            })
        }
    }else{
        return;
    }

}