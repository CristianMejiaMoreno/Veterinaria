export async function borrarEspecie(id){

    Swal.fire({
        title:"Estas seguro de borrar la especie?",
        text:"Una vez hecho no podras recuperar las datos!",
        icon:"warning",
        showCancelButton: true,
        confirmButtonText : "Si, deseo borrarlo"
    }).then(async (result)=>{
        
        if(result.isConfirmed){

            const url = window.APP_URL + '/admin/especies/'+id
            const token = document.querySelector('meta[name="csrf-token"]').content;

            const response = await fetch(url, {
                method:'DELETE',
                headers:{'X-CSRF-TOKEN': token}
            })

            if(response.ok){
                window.LaravelDataTables['especie-table'].ajax.reload(null, false);
                Swal.fire({title:"La eliminacion fue exitosa", icon:"success"})
            }else{
                Swal.fire({title:"La eliminacion no fue exitosa", icon:"error"})
            }
        }
    })

}