export async function borrarCliente (id) {


    Swal.fire({
        title: "Estas seguro de borrar el cliente",
        text: "Una vez hecho no se podran recuperar los datos",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText : "Si, deseo borrarlo"
    }).then(async (result)=>{

        if(result.isConfirmed){

            const url = window.APP_URL + '/admin/clientes/' + id
            const token = document.querySelector('meta[name="csrf-token"]').content;

            const borrar = await fetch(url, {
                method : "DELETE",
                headers : {
                    'Content-Type' : 'application/json',
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                }
            });

            if(borrar.ok)
            {
                window.LaravelDataTables["clientes-table"].ajax.reload(null, false);
                Swal.fire({
                    title: "La eliminacion fue exitosa!",
                    icon: "success"
                });
            }else {
                Swal.fire({
                    title: "La eliminacion no fue exitosa!",
                    icon: "error"
                });
            }
        }


    });

}
