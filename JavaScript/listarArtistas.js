const opciones = {
    method: 'POST'
}

const $select = document.querySelector("#artista");

fetch('./PHP/ListarArtistas.php', opciones)
    .then(respuesta => respuesta.json())
    .then(resultado => {
        
        resultado.forEach(element => {
            const option = document.createElement('OPTION');
            option.value = element.art_nombre;
            option.text = element.art_nombre;
            $select.appendChild(option);
        });        
    })
