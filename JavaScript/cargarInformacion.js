const opciones = {
    method: 'POST'
}

const tabla = document.querySelector('#datatable tbody');

fetch('./PHP/MostrarProductos.php', opciones)
    .then(respuesta => respuesta.json())
    .then(resultado => {

        console.log(resultado);

        resultado.forEach(element => {
            const renglon = document.createElement('TR');
            
            element.forEach(cell => {
                const celda = document.createElement('TD');
            })
        })             
    })