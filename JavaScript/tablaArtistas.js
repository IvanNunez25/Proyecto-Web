
let dataTableArtistas;
let dataTableArtistasInicializada = false;

const dataTableArtistasOpciones = {
    columnDefs: [
        { className: "centrado", targets: [4] },
        { orderable: false, targets: [4] }
    ],
    pageLength: 10,
    destroy: true,
    language: {
        lengthMenu: "Mostrar _MENU_ resgistros por página",
        zeroRecords: "Ningún registro encontrado",
        info: "Mostrando de _START_ a _END_ de un total de _TOTAL_ registros",
        infoEmpty: "Ningun registro encontrado",
        infoFiltered: "(filtrados desde _MAX_ registros totales)",
        search: "Buscar:",
        loadingRecords: "Cargando ...",
        paginate: {
            first: "Primero",
            last: "Último",
            next: "Siguiente",
            previous: "Anterior"
        }
    }
}

const iniciarDataTableArtistas = async () => {
    if (dataTableArtistasInicializada) {
        dataTableArtistas.destroy();
    }

    await listarArtistas();

    dataTable = $("#datatable_artistas").DataTable(dataTableArtistasOpciones);

    dataTableArtistasInicializada = true;
}

const listarArtistas = async () => {
    try {
        // const response = await fetch('https://jsonplaceholder.typicode.com/users');
        const responseArtistas = await fetch('./PHP/MostrarArtistas.php', opciones);
        const artistas = await responseArtistas.json();

        let contentArtistas = ``;
        artistas.forEach((artista, index) => {
            contentArtistas += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${artista.art_nombre}</td>
                    <td>${artista.art_tipo}</td>
                    <td>${artista.art_productos}</td>
                    <td><button class="btn btn-sm btn-danger" onclick='eliminar(${artista.art_id})'><i class="fa-solid fa-trash"></i></button></td>
                </tr>`;
        });

        // ID del cuerpo de la tabla
        tableBody_artistas.innerHTML = contentArtistas;
    } catch (error) {
        console.log(error);
    }
}

function eliminar(ID_artista) {
    Swal.fire({
        title: 'Eliminar Artista',
        text: '¿Deseas eliminar el artista seleccionado?',
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `PHP/EliminarArtista.php?id=${ID_artista}`;
        }
    })
}

window.addEventListener('load', async () => {
    await iniciarDataTableArtistas();
});