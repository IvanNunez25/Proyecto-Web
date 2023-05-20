const tabla = document.querySelector('#datatable tbody');

const listado = async ()  => {
    await fetch('./PHP/MostrarProductos.php', opciones)
    .then(respuesta => respuesta.json())
    .then(resultado => {

        resultado.forEach(element => {
            const renglon = document.createElement('TR');
            
            element.forEach(cell => {
                const celda = document.createElement('TD');
            })
        })             
    })
}

document.addEventListener('load', listado());    