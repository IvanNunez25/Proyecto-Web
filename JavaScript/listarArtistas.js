const opciones = {
    method: 'POST'
}

const $select = document.querySelector("#artista");

const limpiar = () => {
    for (let i = $select.options.length; i >= 0; i--) {
        $select.remove(i);
    }
}

fetch('./PHP/ListarArtistas.php', opciones)
    .then(respuesta => respuesta.json())
    .then(resultado => {

        console.log(resultado);

        resultado.forEach(element => {
            const option = document.createElement('OPTION');
            option.value = element.art_nombre;
            option.text = element.art_nombre;
            $select.appendChild(option);                    
        })             
    })


function cambiar() {
    const tipo = document.querySelector('#comboBox').value;
    limpiar()

    fetch('./PHP/ListarArtistas.php', opciones)
    .then(respuesta => respuesta.json())
    .then(resultado => {

        console.log(resultado);

        resultado.forEach(element => {
            if(element.art_tipo == tipo){
            const option = document.createElement('OPTION');
            option.value = element.art_nombre;
            option.text = element.art_nombre;
            $select.appendChild(option); }                      
        })             
    })

}


// function listar () {

//     limpiar();

//     fetch('./PHP/ListarArtistas.php', opciones)
//     .then(respuesta => respuesta.json())
//     .then(resultado => {
        

//         resultado.forEach(element => {
//             if(element.art_tipo == tipo){
//                 const option = document.createElement('OPTION');
//                 option.value = element.art_nombre;
//                 option.text = element.art_nombre;
//                 $select.appendChild(option); 
//             }                
//         })             
//     })

// }


// $select.addEventListener('click', listar());


